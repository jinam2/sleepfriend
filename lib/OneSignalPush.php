<?php

include_once __DIR__ . "/CurlWrapper.php";
require_once __DIR__ . "/SimpleDB.php";

class OneSignalPush
{

    private $apikey = "";
    private $curl = null;
    private $config = null;
    private $base_url = "https://onesignal.com";

    private $app_id = "32749154-3ce9-474e-aa62-35d954f93687";
    private $api_key = "OWQ0Mjg3N2EtNTc3Ny00MDJmLWI5NmUtMmFjNTNhODIzNDg3";
    private $default_headers = [
            "Content-Type" => "application/json; charset=utf-8",
        ];

    private $cookie_file = "";


    /**
     *
    작성된 상품문의에 답변
    - 문구 : 작성하신 상품문의에 답변이 등록되었습니다.
    - 이동 : 마이페이지 > 주문배송조회 > 상품 문의 > 해당 상품문의 상세

    작성된 상담문의에 답변
    - 문구 : 작성하신 상담문의에 답변이 등록되었습니다.
    - 이동 : 마이페이지 > 예약내역 > 상담 신청내역 > 해당 상담문의 상세

    주문 완료
    - 문구 : 상품의 주문이 완료되었습니다.
    - 이동 : 마이페이지 > 주문/배송조회 > 주문내역 > 해당 주문내역 상세

    렌탈신청 완료
    - 문구 : 상품의 렌탈 신청이 완료되었습니다.
    - 이동 : 마이페이지 > 계약정보 > 해당 렌탈신청 내역 상세

    병원예약일 등록 완료
    - 문구 : 병원예약일 등록이 완료되었습니다.
    - 이동 : 마이페이지 > 병원진료일정 목록

    병원예약일 하루 전(정오에 발송)
    - 문구 : 등록하신 병원예약일 하루 전입니다.
    - 이동 : 마이페이지 > 병원진료일정 목록

    처방등록 완료
    - 문구: 처방 등록이 완료되었습니다.
    - 이동 : 마이페이지 > 계약정보 > 해당 계약상품 정보 상세

     *
     */
    function __construct()
    {

    }

    public function ping() {

        $this->curl->clearOptions();
        $url = sprintf("%s/api/v1/ping", $this->base_url);
        $response = $this->curl->get($url);
    }

    public function sendUserNotification($userid, $message, $target_url = "", $data = []) {

        $url = sprintf("%s/api/v1/notifications", $this->base_url);

        $params = [
            'app_id' => $this->app_id,
            'include_external_user_ids' => is_array($userid) ? $userid :  [$userid],
            'channel_for_external_user_ids' => 'push',
            'contents' => [
                'en' => $message
            ]
        ];

        if($target_url) {
            $params['url'] = $target_url;
        }
        if(!empty($data)) {
            $params['data'] = $data;
        }

        $fields = json_encode($params, JSON_UNESCAPED_UNICODE);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$this->api_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }


    /**
     *  작성된 상품문의에 답변
    - 문구 : 작성하신 상품문의에 답변이 등록되었습니다.
    - 이동 : 마이페이지 > 주문배송조회 > 상품 문의 > 해당 상품문의 상세

     * @param $userid
     * @param $message
     * @param $url
     * @return void
     */
    public function sendGoodsQaReplyNotification($userid, $message, $url = "") {

        $this->sendUserNotification($userid, $message, $url);
    }

    /**
     *
    작성된 상담문의에 답변
    - 문구 : 작성하신 상담문의에 답변이 등록되었습니다.
    - 이동 : 마이페이지 > 예약내역 > 상담 신청내역 > 해당 상담문의 상세
     * @param $userid
     * @param $message
     * @param $url
     * @return void
     */
    public function sendQaReplyNotification($userid, $message, $url = "") {

        $this->sendUserNotification($userid, $message, $url);
    }

    /**
     *     주문 완료
    - 문구 : 상품의 주문이 완료되었습니다.
    - 이동 : 마이페이지 > 주문/배송조회 > 주문내역 > 해당 주문내역 상세
     * @param $userid
     * @param $message
     * @param $url
     * @return void
     */
    public function sendGoodsOrderNotification($userid, $message, $url = "") {

        $this->sendUserNotification($userid, $message, $url);
    }


    /**
     *    렌탈신청 완료
    - 문구 : 상품의 렌탈 신청이 완료되었습니다.
    - 이동 : 마이페이지 > 계약정보 > 해당 렌탈신청 내역 상세
     * @param $userid
     * @param $message
     * @param $url
     * @return void
     */
    public function sendGoodsRentalNotification($userid, $message, $url = "") {

        $this->sendUserNotification($userid, $message, $url);
    }

    /**
     *  병원예약일 등록 완료
    - 문구 : 병원예약일 등록이 완료되었습니다.
    - 이동 : 마이페이지 > 병원진료일정 목록
     * @param $userid
     * @param $message
     * @param $url
     * @return void
     */
    public function sendHospitalReservationNotification($userid, $message, $url = "") {

        $this->sendUserNotification($userid, $message, $url);
    }

    /**
     *     병원예약일 하루 전(정오에 발송)
    - 문구 : 등록하신 병원예약일 하루 전입니다.
    - 이동 : 마이페이지 > 병원진료일정 목록
     * @param $userid
     * @param $message
     * @param $url
     * @return void
     */
    public function sendHospitalScheduleNotification($userid, $message, $url = "") {

        $this->sendUserNotification($userid, $message, $url);
    }


    /**
     *     처방등록 완료
    - 문구: 처방 등록이 완료되었습니다.
    - 이동 : 마이페이지 > 계약정보 > 해당 계약상품 정보 상세
     * @param $userid
     * @param $message
     * @param $url
     * @return void
     */
    public function sendPrescriptionScheduleNotification($userid, $message, $url = "") {

        $this->sendUserNotification($userid, $message, $url);
    }

    public function sendNotification() {

    }

}
