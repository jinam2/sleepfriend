<?php

include_once __DIR__ . "/CurlDownloader.php";
require_once __DIR__ . "/SimpleDB.php";
require_once __DIR__ . "/MediUtil.php";

class MediSync extends SimpleDB
{

    private $apikey = "";
    private $curl = null;
    private $config = null;
    private $base_url = "https://ap-airview.resmed.com";

    private $login_userid = "";
    private $login_password = "";

    private $default_headers = [
            //"Referer" => "https://ap-airview.resmed.com/login",
            "Accept-Language" => "ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7,ja;q=0.6,zh;q=0.5,zh-CN;q=0.4",
            "Origin" => "https://ap-airview.resmed.com",
            "Content-Type" => "application/x-www-form-urlencoded",
            "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36",
        ];

    private $cookie_file = "";

    function __construct($pdo_db = null, $options = [])
    {
        if ($pdo_db) {
            parent::__construct($pdo_db);
        }

        if (isset($options['login_userid'])) {
            $this->login_userid = $options['login_userid'];
        }

        if (isset($options['login_password'])) {
            $this->login_password = $options['login_password'];
        }

        if (isset($options['cookie_file'])) {
            $this->cookie_file = $options['cookie_file'];
        } else {
            $this->cookie_file = dirname(__DIR__)."/data/medi_cookie.txt";
        }

        $this->curl = new CurlDownloader();

        if(!file_exists($this->cookie_file)) {
            touch($this->cookie_file);
        }

        $this->curl->setCookieFile($this->cookie_file);
        $this->curl->addHeader($this->default_headers);

        if(!$this->login_userid) {
            $config = $this->row("select * from sleep_config limit 1");
            $this->login_userid = $config['resmed_username'];
            $this->login_password = $config['resmed_password'];
        }
    }

    public function getJSESSIONID() {
        $url = sprintf("%s", $this->base_url);


        //$this->curl->addOption(CURLOPT_RETURNTRANSFER, false);
        $this->curl->addOption(CURLOPT_FOLLOWLOCATION, false);
        $this->curl->addOption(CURLOPT_HEADER, true);
        $this->curl->addOption(CURLOPT_NOBODY, 0);
        $this->curl->setFollowRedirects(false);

        $response = $this->curl->get($url);

        //todo 파일이 정상 다운로드 되었는지 확인

        $response_cookies = $this->curl->getResponseHeader('set-cookie');
    }

    public function login() {
        $url = sprintf("%s/doLogin", $this->base_url);
        $data = [
            "userid" => $this->login_userid,
            "password" => $this->login_password
        ];

        $this->curl->clearOptions();

        $params = ['j_username' => $this->login_userid, 'j_password' => $this->login_password];
        $response = $this->curl->post($url, $params);


    }

    public function getTestData() {

        $this->curl->clearOptions();
        $url = sprintf("%s/admin/users", $this->base_url);
        $response = $this->curl->get($url);

    }

    public function getPatient($q = null) {


        //sales force 아이디로 검색한다.


        $this->curl->clearOptions();
        $url = sprintf("%s/patients", $this->base_url);

        $params = [
            "q" => "",
            "locationId" => "",
            "selectedStatus" => "Active",
            "becameCompliant" => "",
            "selectedTroubleshooting" => "",
            "selectedTherapyMode" => "",
            "numperpage" => "100",
        ];

        if($q) { //검색쿼리가 있는 경우
            $params['q'] = $q;
        }

        $response = $this->curl->get($url, $params);

        /**
         * q:
        currentQ:
        numperpage: 50
        search: 환자 검색
        userId:
        locationId:
        selectedStatus: Active
        becameCompliant:
        selectedTroubleshooting:
        selectedTherapyMode:
        _csrf: 033fde21-aec7-4f38-a557-95671b44f76d
        pagenum: 2
         */
        $count = $this->parsePatient($response);

        if($count > 0 && !$q) { //환자별 검색후 싱크인 경우는 시간 업데이트를 하지 않는다.
            //싱크 시간 업데이트
            $this->query("update sleep_config set resmed_sync_datetime = now() where 1=1 limit 1");
        }

        return $count;

    }

    /**
     * html 데이타에서 환자 정보를 추출하여 DB에 저장한다.
     * 기존 환자 정보가 있는 경우 update 한다.
     * @param $html string
     * @return int 매칭되어 업데이트 되거나, 신규 추가된 환자 수
     */
    private function parsePatient($html) {
        preg_match('#<script type="text/javascript">ResMed.ECO.Pages.setVar\\("patients",(.*?)\\);</script>#ism',$html,$matches);
        $count = 0;
        if($matches) {
            $patients = json_decode($matches[1], true);

            if($patients) {
                foreach ($patients as $patient) {
                    $this->insertOrUpdatePatient($patient);
                    $count++;
                }
            }
        }

        return $count;
    }

    /**
     * @param $easy_care_number
     * @param $download_dir
     * @param $filename
     * @param $period_days pdf 생성시 기간
     * @return bool
     */
    public function downloadComplianceReport($easy_care_number, $download_dir, $filename, $period_days = 30, $options = []) {
         //https://ap-airview.resmed.com/patients/a926daa3-6f33-4e81-87cb-2df3fd41ddf8/report/compliance/Compliance_report_07272022_232236.pdf?returningUrl=%2Fpatients%2Fa926daa3-6f33-4e81-87cb-2df3fd41ddf8&reportType=Compliance&reportPeriodType=SUPPLIED&reportingPeriodLength=30&reportingPeriodStart=undefined&reportingPeriodEnd=2022%2F07%2F27&nightProfileDays=7
        //Compliance_report_07272022_232236.pdf

        $this->curl->clearOptions();
        $url = sprintf("%s/patients/%s/report/compliance/validate", $this->base_url, $easy_care_number);


        if($options['from_date'] && $options['to_date']) {
            $reportingPeriodStart = date("Y/m/d", strtotime($options['from_date']));
            $reportingPeriodEnd = date("Y/m/d", strtotime($options['to_date']));
        } else {
            $reportingPeriodStart = date("Y/m/d", strtotime("-" . $period_days . " days"));
            $reportingPeriodEnd = date("Y/m/d");
        }

        /*
        $params = [
            "returningUrl" => "/patients/a926daa3-6f33-4e81-87cb-2df3fd41ddf8",
            "reportType" => "Compliance",
            "reportPeriodType" => "DATERANGE",
            "reportingPeriodLength" => $period_days,
            "reportingPeriodStart" => "2022/06/28",
            "reportingPeriodEnd" => "2022/07/27",
            "nightProfileDays" => "7",
        ];
        */

        $params = [
            'returningUrl' => '/patients/'.$easy_care_number,
            'reportType' => 'Compliance',
            'reportPeriodType' => 'DATERANGE',
            'reportingPeriodLength' => $period_days,
            'reportingPeriodStart' => $reportingPeriodStart,
            'reportingPeriodEnd' => $reportingPeriodEnd,
            'nightProfileDays' => '7',
        ];

        //$download_filename = "Compliance_report_07272022_232702.pdf";
        $url = sprintf("%s/patients/%s/report/compliance/%s", $this->base_url, $easy_care_number, $filename);

        $download_filename = $download_dir."/".$filename;

        try {
            $this->curl->download($url, $download_filename, 'GET', $params);
            $status = $this->curl->getTransferInfo('http_code');

            if($status == 200) {
                return true;
            } else {

            }
        } catch(\Exception $ex) {

        }
       return false;
    }

    private function insertOrUpdatePatient($patient) {
        $complianceRange = $patient['patientComplianceData']['complianceRange'];
        $compliance_from_date = $complianceRange['from'] ? sprintf("%s-%02d-%02d", $complianceRange['from'][0], $complianceRange['from'][1], $complianceRange['from'][2]) : null;
        $compliance_to_date = $complianceRange['to'] ? sprintf("%s-%02d-%02d", $complianceRange['to'][0], $complianceRange['to'][1], $complianceRange['to'][2]) : null;
        $setup_date = is_array($patient['setupDate']) ? sprintf("%s-%02d-%02d", $patient['setupDate'][0], $patient['setupDate'][1], $patient['setupDate'][2]) : null;
        $params = [
            'id' => $patient['id'],
            'easy_care_number' => $patient['easyCareNumber'],
            'username' => $patient['firstName']." ".$patient['lastName'],
            'available_data' => $patient['availableData'],
            'monitoring_method' => $patient['monitoringMethod'],
            'compliance_from_date' => $compliance_from_date,
            'compliance_to_date' => $compliance_to_date,
            'setup_date' => $setup_date,
            'salesforce_id' => $patient['mrn']

        ];


        $sql = "insert into patients SET
                    id = :id,
                    easy_care_number = :easy_care_number,
                    username = :username,
                    available_data = :available_data,       
                    setup_date = :setup_date,       
                    monitoring_method = :monitoring_method,
                    compliance_from_date = :compliance_from_date,
                    compliance_to_date = :compliance_to_date,
                    salesforce_id = :salesforce_id,
                    create_datetime = now()
                on duplicate key update
                    easy_care_number = :easy_care_number,
                    username = :username,
                    available_data = :available_data,
                    setup_date = :setup_date,   
                    monitoring_method = :monitoring_method,
                    compliance_from_date = :compliance_from_date,
                    compliance_to_date = :compliance_to_date,
                    salesforce_id = :salesforce_id,
                    update_datetime = now()
                    
        ";

        $this->query($sql, $params);

    }

    /**
     * 수면 보고서를 생성 정보를 DB에 저장한다.
     * @param $patient_id
     * @param $easy_care_number
     * @param $filename
     * @param $period_days
     * @param $salesforce_prescription_id 세일즈포스 처방 아이디
     * @param $creation_purpose  수면보고서 생성 목적
     * @return string
     */
    public function insertComplianceReport($patient_id, $easy_care_number, $filename, $period_days = 30, $salesforce_prescription_id = null, $creation_purpose = null) {
        $params = [
            'patient_id' => $patient_id,
            'easy_care_number' => $easy_care_number,
            'pdf_filename' => $filename,
            'period_days' => $period_days,
            'salesforce_prescription_id' => $salesforce_prescription_id,
            'creation_purpose' => $creation_purpose,
        ];

        $sql = "insert into patient_report_history SET
                    patient_id = :patient_id,
                    easy_care_number = :easy_care_number,
                    pdf_filename = :pdf_filename,
                    period_days = :period_days,
                    salesforce_prescription_id = :salesforce_prescription_id,
                    creation_purpose = :creation_purpose,
                    is_extract = 'n',
                    create_datetime = now()
        ";

        $this->query($sql, $params);
        return $this->lastInsertId();
    }

    public function getPatientsFromDB() {
        //$sql = "select * from patients";
        //$sql = "select * from patients where id in(4848710,4961172, 4672553, 4863556, 4848737)"; //테스트
        //todo 마지막 업데이트가 있는지를 체크하여, 마지막 업데이트 일자에 맞춰서 새로 다운로드 하도록 해야 함
        $sql = "select * from patients where salesforce_id is not null "; //테스트
        return $this->query($sql);
    }

    /**
     * 해당 방문일정의 사용자 정보를 조회
     * @param $date 병원 방문일정
     * @return array|int|null
     */
    public function getPatientsVisitSchedule($date) {
        $sql = "
                SELECT *, P2.id as resmed_patient_id, P2.easy_care_number
                FROM SF_PRESCRIPTION P inner join patients P2 on(P.PATIENT_ID = P2.salesforce_id)
                WHERE next_doctor_datetime  between '{$date} 00:00:00' and '{$date} 23:59:59'
            ";

        return $this->query($sql);
    }

    /**
     * 처방 만료일이 동일한 데이타 조회
     * @param $date
     * @return array|int|null
     */
    public function getPatientsPrescriptionEndDate($date) {
        $sql = " SELECT P.*, P2.id as resmed_patient_id, P2.easy_care_number
                    FROM SF_PRESCRIPTION P inner join patients P2 on(P.PATIENT_ID = P2.salesforce_id)
                    WHERE END_DATE = '{$date}' 
            ";
        return $this->query($sql);
    }



    public function getPatientFromDB($id) {
        //$sql = "select * from patients";
        //$sql = "select * from patients where id in(4848710,4961172, 4672553, 4863556, 4848737)"; //테스트
        //todo 마지막 업데이트가 있는지를 체크하여, 마지막 업데이트 일자에 맞춰서 새로 다운로드 하도록 해야 함
        $sql = "select * from patients where id=:id "; //테스트
        return $this->row($sql, ['id' => $id]);
    }

    public function getNotParsingPatientReportHistory() {
        $sql = "select * from patient_report_history where is_extract='n'";
        return $this->query($sql);
    }

    public function getPatientReportHistoryFromDB($seq) {
        $sql = "select * from patient_report_history where seq = :seq";
        return $this->row($sql, ['seq' => $seq]);
    }

    public function updatePatientReportParsingResult($seq, $pdf_data, $ret_code, $ret_message) {
        $params = [
            'seq' => $seq,
            'pdf_data' => $pdf_data,
            'ret_code' => $ret_code,
            'ret_message' => $ret_message,
        ];

        //todo pdf 데이타에서 순응도 관련 정보를 추출하여 patient 에 업데이트 처리한다.

        $sql = "update patient_report_history SET
                    is_extract = 'y',
                    pdf_data = :pdf_data,
                    ret_code = :ret_code,
                    ret_message = :ret_message,
                    update_datetime = now(),
                    pdf_extract_datetime = now()
                where seq = :seq
        ";

        $this->query($sql, $params);

        $pdf_values = MediUtil::extractComplianceValues($pdf_data);


        if(count($pdf_values) > 1)  {
            $sql = "UPDATE patient_report_history SET 
                        total_avg_used_minute = :total_avg_used_minute,
                        leak_median_value = :leak_median_value,
                        ahi_median_value = :ahi_median_value,
                        from_date = :from_date,
                        to_date = :to_date
                    WHERE seq = :seq
            ";
            $params = [
                'seq' => $seq,
                'total_avg_used_minute' => $pdf_values['total_avg_used_minute'],
                'leak_median_value' =>  $pdf_values['leak_median'],
                'ahi_median_value' =>  $pdf_values['ahi_median'],
                'from_date' =>  $pdf_values['from_date'],
                'to_date' =>  $pdf_values['to_date'],
            ];

            $this->query($sql, $params);
        }
    }

    public function onlyHanAlpha($subject) {
        $pattern = '/([\xEA-\xED][\x80-\xBF]{2}|[\x20-\x7e])+/';
        preg_match_all($pattern, $subject, $match);
        return implode('', $match[0]);
    }

}
