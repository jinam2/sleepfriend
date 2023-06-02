<?php

include_once __DIR__ . "/CurlWrapper.php";
require_once __DIR__ . "/SimpleDB.php";

class SalesForceSync extends SimpleDB
{

    private string $apikey = "";
    private $curl = null;
    private $config = null;
    private $bizId = "";
    //private $base_url = "https://forcecom-2ce--sandbox2.sandbox.my.salesforce-sites.com";
    private $base_url = "https://forcecom-2ce.my.salesforce-sites.com";

    private $mmdd = "";

    private $secureCode = "";

    private $login_userid = "";
    private $login_password = "";

    private $default_headers = [
            "Accept-Language" => "ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7,ja;q=0.6,zh;q=0.5,zh-CN;q=0.4",
            "Content-Type" => "application/json",
            "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36",
     ];

    private $cookie_file = "";

    function __construct($pdo_db = null, $options = [])
    {
        if ($pdo_db) {
            parent::__construct($pdo_db);
        }

        $this->mmdd = date("md");

        if (isset($options['cookie_file'])) {
            $this->cookie_file = $options['cookie_file'];
        } else {
            $this->cookie_file = dirname(__DIR__)."/data/salesforce_cookie.txt";
        }

        $this->curl = new CurlWrapper();

        //$this->initCookieFile(); //bizcallmix api 는 로그인 인증을 사용하지 않음.
        $this->curl->addHeader($this->default_headers);
    }

    private function initCookieFile() {
        if(!file_exists($this->cookie_file)) {
            touch($this->cookie_file);
        }
        $this->curl->setCookieFile($this->cookie_file);
    }

    public function login() {
        $url = sprintf("%s/doLogin", $this->base_url);
        $data = [
            "userid" => $this->login_userid,
            "password" => $this->login_password
        ];

        $params = ['username' => $this->login_userid, 'password' => $this->login_password];
        $response = $this->curl->post($url, $params);
    }

    public function get_contract($accid) {
        $url = sprintf("%s/services/apexrest/IF_GET_CONTRACT?accid=%s", $this->base_url, $accid);
        echo $url."\n";
        return $this->curl->get($url);
    }

    public function get_order($accid) {
        $url = sprintf("%s/services/apexrest/IF_GET_ORDER?accid=%s", $this->base_url, $accid);
        return $this->curl->get($url);
    }

    public function get_invoice($accid) {
        $url = sprintf("%s/services/apexrest/IF_GET_INVOICE?accid=%s", $this->base_url, $accid);
        return $this->curl->get($url);
    }

    public function get_payment($accid) {
        $url = sprintf("%s/services/apexrest/IF_GET_PAYMENT?accid=%s", $this->base_url, $accid);
        return $this->curl->get($url);
    }

    /**
     * 처방조회
     * @param $contid 계약 아이디(SF_CONTRACT.ID)
     * @return string
     */
    public function get_prescription($contid) {
        $url = sprintf("%s/services/apexrest/IF_GET_PRESCRIPTION?contid=%s", $this->base_url, $contid);
        return $this->curl->get($url);
    }

    /**
     * @param $id SF_PRESCRIPTION.ID 처방 아이디
     * @param $tz_time
     * @return void
     */
    public function set_prescription_schedule($id, $tz_time) {
        $url = sprintf("%s/services/apexrest/IF_PRESCRIPTION", $this->base_url);
        $params = [
            'PREID' => $id,
            'NEXT_DOCTOR_APPOINTMENT' => $tz_time
        ];
        //return $this->curl->post($url, $params);

        $log_seq = $this->insert_call_log($url, 'POST', $params);
        $response = $this->curl->rawPost($url, json_encode($params));
        $this->update_call_log($log_seq, $response);
        return $response;
    }

    /**
     * 순응데이타 생성시 salesforce 전송
     * @param $id 환자 아이디
     * @param $export_date 데이타 확인일
     * @param $start_date 순응평가 시작일
     * @param $end_date 순응평가 종료일
     * @param $usage 평균 사용량
     * @param $ahi_index AHI 지수
     * @param $average_usage_time 하루평균사용시간
     * @return
     */
    public function set_usage_data($id, $export_date, $start_date, $end_date, $usage, $ahi_index, $average_usage_time) {
        $url = sprintf("%s/services/apexrest/IF_USAGEDATA", $this->base_url);

        $params = [
            'ACCID' => $id,
            'DATA_EXPORTDATE' => $export_date,
            'COMPILANCE_STARTDATE' => $start_date,
            'COMPILANCE_ENDDATE' => $end_date,
            'USAGE' => $usage,
            'AHI_INDEX' => $ahi_index,
            'AVERAGE_USAGE_TIME' => $average_usage_time,
        ];

        $log_seq = $this->insert_call_log($url, 'POST', $params);
        $response = $this->curl->rawPost($url, json_encode($params));
        $this->update_call_log($log_seq, $response);

        return $response;
    }

    /**
     * 상담생성
     * @param $id 환자ID
     * @param $call_activity_type 상담유형
     * @param $call_activity_sub_type 상담유형(하위)
     * @param $product 상담제품 ex. 노제욱_221110_양압기 상담  (임의조합하여 전송요청)
     * @param $subject 제목
     * @param $start_datetime 시작시간 2022-11-20T07:47:00.000Z         (-9시간 하여 전송요청)
     * @param $end_datetime 종료시간 2022-11-20T08:10:00.000Z         (-9시간 하여 전송요청)
     * @param $description 상담내용
     * @return string
     */
    public function set_reservation_data($id, $call_activity_type, $call_activity_sub_type, $product, $subject, $start_tz_time, $end_tz_time,  $description) {
        $url = sprintf("%s/services/apexrest/IF_EVENT", $this->base_url);

        $params = [
            'ACCID' => $id,
            'CALL_ACTIVITY_TYPE' => $call_activity_type,
            'CALL_ACTIVITY_SUB_TYPE' => $call_activity_sub_type,
            'PRODUCT' => $product,
            'SUBJECT' => $subject,
            'STARTDATETIME' => $start_tz_time,
            'ENDDATETIME' => $end_tz_time,
            'DESCRIPTION' => $description,
        ];

        $log_seq = $this->insert_call_log($url, 'POST', $params);
        $response = $this->curl->rawPost($url, json_encode($params));
        $this->update_call_log($log_seq, $response);

        return $response;
    }

    /**
     * @param $id 환자ID
     * @param $order_date 주문일자 (2022.11.10)
     * @param $product_code 제품코드 (Sample PRODUCT_CODE: KRX200T15, KRX500T15)
     * @param $quantity 수량
     * @param $price 단가
     * @param $delivery_method 출고방법 (현장=1, 택배=2, 기존기기사용)
     * @param $invoice_number 택배송장번호
     * @param $payment_method 입금수단 (현금, 카드)
     * @return void
     */
    public function set_order_data($id, $order_date, $product_code, $quantity, $price, $delivery_method, $invoice_number, $payment_method) {
        $url = sprintf("%s/services/apexrest/IF_ORDER", $this->base_url);

        $params = [
            'ACCID' => $id,
            'ORDER_DATE' => $order_date,
            'PRODUCT_CODE' => $product_code,
            'QUANTITY' => $quantity,
            'PRICE' => $price,
            'DELIVERY_METHOD' => $delivery_method,
            'INVOICE_NUMBER' => $invoice_number,
            'PAYMENT_METHOD' => $payment_method,
        ];

        $log_seq = $this->insert_call_log($url, 'POST', $params);
        $response = $this->curl->rawPost($url, json_encode($params));
        $this->update_call_log($log_seq, $response);

        return $response;
    }


    public function insertOrUpdateContract($account, $params) {
        $params['PATIENT_ID'] = $account;
        $sql = "select * from SF_CONTRACT where ID = :id";
        $row = $this->row($sql, ['id' => $params['ID']]);
        //$params['PATIENT'] = substr($params['PATIENT'], 0, 15); //20230420 아이디 15자리수 문제 수정
        if(!$row) {
            $sql = "INSERT INTO SF_CONTRACT 
                        SET
                        ID = :ID,
                        PATIENT_ID = :PATIENT_ID,    
                        PATIENT = :PATIENT,        
                        TYPE_OF_INSURANCE = :TYPE_OF_INSURANCE,        
                        START_DATE = :START_DATE,        
                        EXPIRE_DATE = :EXPIRE_DATE,        
                        REAL_START_DATE = :REAL_START_DATE,        
                        REAL_EXPIRE_DATE = :REAL_EXPIRE_DATE,        
                        RETURN_DATE = :RETURN_DATE,        
                        RETRUN_REASON = :RETRUN_REASON,        
                        PRESCRIPTION_HOSPITAL = :PRESCRIPTION_HOSPITAL,        
                        PRODUCT_FAMILY = :PRODUCT_FAMILY,        
                        OPERATION_TYPE = :OPERATION_TYPE,        
                        RENTAL_FEE_PAYDAY = :RENTAL_FEE_PAYDAY,        
                        DEVICE_MODEL_NAME = :DEVICE_MODEL_NAME,        
                        SN = :SN,        
                        PAYMENT_METHOD = :PAYMENT_METHOD,        
                        MASK_ORDER_DATE = :MASK_ORDER_DATE,        
                        CONTRACT_TYPE = :CONTRACT_TYPE,        
                        CONTRACT_PDF = :CONTRACT_PDF,        
                        LINKED_PRESCRIPTION = :LINKED_PRESCRIPTION,
                        create_datetime = now(),        
                        update_datetime = now()      
            ";

            $this->query($sql, $params);
        } else {
            $sql = "UPDATE SF_CONTRACT 
                        SET
                        PATIENT_ID = :PATIENT_ID,    
                        PATIENT = :PATIENT,  
                        TYPE_OF_INSURANCE = :TYPE_OF_INSURANCE,        
                        START_DATE = :START_DATE,        
                        EXPIRE_DATE = :EXPIRE_DATE,        
                        REAL_START_DATE = :REAL_START_DATE,        
                        REAL_EXPIRE_DATE = :REAL_EXPIRE_DATE,        
                        RETURN_DATE = :RETURN_DATE,        
                        RETRUN_REASON = :RETRUN_REASON,        
                        PRESCRIPTION_HOSPITAL = :PRESCRIPTION_HOSPITAL,        
                        PRODUCT_FAMILY = :PRODUCT_FAMILY,        
                        OPERATION_TYPE = :OPERATION_TYPE,        
                        RENTAL_FEE_PAYDAY = :RENTAL_FEE_PAYDAY,        
                        DEVICE_MODEL_NAME = :DEVICE_MODEL_NAME,        
                        SN = :SN,        
                        PAYMENT_METHOD = :PAYMENT_METHOD,        
                        MASK_ORDER_DATE = :MASK_ORDER_DATE,        
                        CONTRACT_TYPE = :CONTRACT_TYPE,
                        LINKED_PRESCRIPTION = :LINKED_PRESCRIPTION,
                        CONTRACT_PDF = :CONTRACT_PDF,   
                        update_datetime = now()      
                    WHERE ID = :ID
            ";
            $this->query($sql, $params);
        }
    }

    /**
     *
     */
    public function insertOrUpdateOrder($account, $params) {
        $params['PATIENT_ID'] = $account;
        $sql = "select * from SF_ORDER where ID = :id";
        $row = $this->row($sql, ['id' => $params['ID']]);
        if(!$row) {
            $sql = "INSERT INTO SF_ORDER 
                        SET
                        ID = :ID,
                        PATIENT_ID = :PATIENT_ID,    
                        NAME = :NAME,        
                        PATIENT = :PATIENT,        
                        ORDER_DATE = :ORDER_DATE,        
                        PRODUCT = :PRODUCT,        
                        QUANTITY = :QUANTITY,        
                        PRICE = :PRICE,        
                        DELIVERY_METHOD = :DELIVERY_METHOD,        
                        INVOICE_NUMBER = :INVOICE_NUMBER,        
                        PAYMENT_METHOD = :PAYMENT_METHOD,        
                        create_datetime = now(),        
                        update_datetime = now()      
            ";

            $this->query($sql, $params);
        } else {
            $sql = "UPDATE SF_ORDER 
                        SET
                        PATIENT_ID = :PATIENT_ID,    
                        NAME = :NAME,        
                        PATIENT = :PATIENT,        
                        ORDER_DATE = :ORDER_DATE,        
                        PRODUCT = :PRODUCT,        
                        QUANTITY = :QUANTITY,        
                        PRICE = :PRICE,        
                        DELIVERY_METHOD = :DELIVERY_METHOD,        
                        INVOICE_NUMBER = :INVOICE_NUMBER,        
                        PAYMENT_METHOD = :PAYMENT_METHOD,        
                        update_datetime = now()        
                    WHERE ID = :ID
            ";
            $this->query($sql, $params);
        }
    }

    /**
     * 청구정보 갱신
     * @param $account
     * @param $params
     * @return void
     */
    public function insertOrUpdateInvoice($account, $params) {
        $params['PATIENT_ID'] = $account;
        $sql = "select * from SF_INVOICE where ID = :id";
        $row = $this->row($sql, ['id' => $params['ID']]);
        if(!$row) {
            $sql = "INSERT INTO SF_INVOICE 
                        SET
                        ID = :ID,
                        PATIENT_ID = :PATIENT_ID,        
                        STATUS = :STATUS,        
                        START_DATE = :START_DATE,        
                        END_DATE = :END_DATE,        
                        NHIS_PAYABLE = :NHIS_PAYABLE,        
                        PATIENT_PAYABLE = :PATIENT_PAYABLE,        
                        CONTRACT_ID = :CONTRACT_ID,        
                        INVOICE_NUMBER = :INVOICE_NUMBER,        
                        PRESCRIPTION_ISSUE_DATE = :PRESCRIPTION_ISSUE_DATE,        
                        create_datetime = now(),        
                        update_datetime = now()      
            ";

            $this->query($sql, $params);
        } else {
            $sql = "UPDATE SF_INVOICE 
                        SET
                        PATIENT_ID = :PATIENT_ID,        
                        STATUS = :STATUS,        
                        START_DATE = :START_DATE,        
                        END_DATE = :END_DATE,        
                        NHIS_PAYABLE = :NHIS_PAYABLE,        
                        PATIENT_PAYABLE = :PATIENT_PAYABLE,    
                        CONTRACT_ID = :CONTRACT_ID,        
                        INVOICE_NUMBER = :INVOICE_NUMBER,        
                        PRESCRIPTION_ISSUE_DATE = :PRESCRIPTION_ISSUE_DATE,    
                        update_datetime = now()        
                    WHERE ID = :ID
            ";
            $this->query($sql, $params);
        }
    }


    /**
     * 이체내역 갱신
     * @param $account
     * @param $params
     * @return void
     */
    public function insertOrUpdatePayment($account, $params) {
        $params['PATIENT_ID'] = $account;
        $sql = "select * from SF_PAYMENT where ID = :id";
        $row = $this->row($sql, ['id' => $params['ID']]);


        if(!$row) {
            $sql = "INSERT INTO SF_PAYMENT
                        SET
                        ID = :ID,
                        PATIENT_ID = :PATIENT_ID,        
                        METHOD = :METHOD,        
                        ACCOUNT_NAME = :ACCOUNT_NAME,        
                        BANKCARD_NAME = :BANKCARD_NAME,        
                        BANKCARD_NUMBER = :BANKCARD_NUMBER,        
                        YY = :YY,        
                        MM = :MM,    
                        CONTRACT_ID = :CONTRACT_ID,    
                        create_datetime = now(),        
                        update_datetime = now()      
            ";

            $this->query($sql, $params);
        } else {
            $sql = "UPDATE SF_PAYMENT 
                        SET
                        PATIENT_ID = :PATIENT_ID,        
                        METHOD = :METHOD,        
                        ACCOUNT_NAME = :ACCOUNT_NAME,        
                        BANKCARD_NAME = :BANKCARD_NAME,        
                        BANKCARD_NUMBER = :BANKCARD_NUMBER,        
                        YY = :YY,        
                        MM = :MM,        
                        CONTRACT_ID = :CONTRACT_ID,
                        update_datetime = now()        
                    WHERE ID = :ID
            ";
            $this->query($sql, $params);
        }
    }


    /**
     * 처방 조회 데이타 업데이트
     * @param $contract_id  계약 아이디
     * @param $params
     * @return void
     */
    public function insertOrUpdatePrescription($contract_id, $params) {
        $params['CONTRACT_ID'] = $contract_id;
        $sql = "select * from SF_PRESCRIPTION where ID = :id";
        //$params['PATIENT_ID'] = substr($params['PATIENT_ID'], 0, 15); //20230420 아이디 15자리수 문제 수정
        $row = $this->row($sql, ['id' => $params['ID']]);
        if(!$row) {
            $sql = "INSERT INTO SF_PRESCRIPTION 
                        SET
                        ID = :ID,
                        CONTRACT_ID = :CONTRACT_ID,
                        PRESCRIPTION_STATUS = :PRESCRIPTION_STATUS,        
                        HOSPITAL = :HOSPITAL,        
                        ISSUE_DATE = :ISSUE_DATE,        
                        START_DATE = :START_DATE,        
                        END_DATE = :END_DATE,        
                        DOCTOR = :DOCTOR,        
                        MEDICAL_DEPARTMENT = :MEDICAL_DEPARTMENT,        
                        PRESCRIPTION_VALUE = :PRESCRIPTION_VALUE,        
                        PATIENT_ID = :PATIENT_ID,
                        PRESCRIPTION_NUMBER = :PRESCRIPTION_NUMBER,
                        PRESCRIPTION_PDF = :PRESCRIPTION_PDF,
                        INSPECTION_PDF = :INSPECTION_PDF,
                        create_datetime = now(),        
                        update_datetime = now()      
            ";

            $this->query($sql, $params);
        } else {
            $sql = "UPDATE SF_PRESCRIPTION 
                        SET
                        CONTRACT_ID = :CONTRACT_ID,
                        PRESCRIPTION_STATUS = :PRESCRIPTION_STATUS,        
                        HOSPITAL = :HOSPITAL,        
                        ISSUE_DATE = :ISSUE_DATE,        
                        START_DATE = :START_DATE,        
                        END_DATE = :END_DATE,        
                        DOCTOR = :DOCTOR,        
                        MEDICAL_DEPARTMENT = :MEDICAL_DEPARTMENT,        
                        PRESCRIPTION_VALUE = :PRESCRIPTION_VALUE,    
                        PATIENT_ID = :PATIENT_ID,
                        PRESCRIPTION_NUMBER = :PRESCRIPTION_NUMBER,
                        PRESCRIPTION_PDF = :PRESCRIPTION_PDF,
                        INSPECTION_PDF = :INSPECTION_PDF,
                        update_datetime = now()        
                    WHERE ID = :ID
            ";

            //echo $sql."\n";
            $this->query($sql, $params);
        }
    }

    protected function insert_call_log($url, $method,  $http_params, $response = null, $call_datetime = null, $response_datetime = null) {

        $http_params = is_array($http_params) || is_object($http_params) ? json_encode($http_params, JSON_UNESCAPED_UNICODE) : $http_params;
        $response = is_array($response) || is_object($response) ? json_encode($response, JSON_UNESCAPED_UNICODE) : $response;
        if(!$call_datetime) $call_datetime = date("Y-m-d H:i:s");

        $sql = "insert into remote_call_log
                        SET
                    url  = :url,                   
                    method  = :method,                   
                    params  = :params,                   
                    response  = :response,                   
                    call_datetime  = :call_datetime,                   
                    response_datetime  = :response_datetime                   
        ";

        $params = [
            "url" => $url,
            "method" => $method,
            "params" => $http_params,
            "response" => $response,
            "call_datetime" => $call_datetime,
            "response_datetime" => $response_datetime,
        ];
        $this->query($sql, $params);

        return $this->lastInsertId();

    }

    protected function update_call_log($seq, $response, $response_datetime = null) {

        $response = is_array($response) || is_object($response) ? json_encode($response, JSON_UNESCAPED_UNICODE) : $response;
        if(!$response_datetime) $response_datetime = date("Y-m-d H:i:s");
        $sql = "update remote_call_log
                        SET
                    response  = :response,                   
                    response_datetime  = :response_datetime         
                where seq = :seq    
        ";

        $params = [
            "response" => $response,
            "response_datetime" => $response_datetime,
            "seq" => $seq
        ];
        $this->query($sql, $params);
    }

}
