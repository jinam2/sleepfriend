<?php


class MediUtil
{


    public static $status_icon = [
        "양호" => "my_icon_good.png",
        "보통" => "my_icon_normal.png",
        "주의" => "my_icon_bad.png",
        ];

    public static $status_icon_lg = [
        "양호" => "my_icon_good_lg.png",
        "보통" => "my_icon_normal_lg.png",
        "주의" => "my_icon_bad_lg.png",
    ];


    public static $status_class = [
        '양호' => "good",
        '보통' => "normal",
        '주의' => "warn",
        ];

    public static function extractComplianceValues($text) {

        $result = [];
        $rows = explode("\n", $text);
        foreach($rows as $row) {
            if(trim($row) == "") continue;

            $row = trim($row);
            if(strpos($row, "사용량") === 0) {
                $use_between_date = trim(str_replace("사용량", "", $row));
                $result['사용량'] = $use_between_date;
                list($from_date, $to_date) = explode(" - ", $use_between_date);
                //todo 적응 날짜. 수정
                $result['from_date'] = str_replace("/", "-", $from_date);
                $result['to_date'] = str_replace("/", "-", $to_date);
            } else if(strpos($row, "누출 - L/min") === 0) {
                $row = str_replace("누출 - L/min", "", $row);

                $pattern = '/([가-힣A-Za-z0-9]+): ([0-9\\.]+)/';
                preg_match_all($pattern, $row, $matches);
                for($i = 0; $i < count($matches); $i++) {
                    $result[$matches[1][$i]] = $matches[2][$i];
                }
            } else if(strpos($row, "무호흡 지수") === 0) {
                $row = str_replace("무호흡 지수", "", $row);

                $pattern = '/([가-힣A-Za-z0-9]+): ([0-9\\.]+)/';

                preg_match_all($pattern, $row, $matches);
                for($i = 0; $i < count($matches); $i++) {
                    $result[$matches[1][$i]] = $matches[2][$i];
                }
            } else if(strpos($row, "평균 사용 (총 일 수)") === 0) {
               $time_str = trim(str_replace("평균 사용 (총 일 수)", "", $row));

                $time_str = trim(str_replace([" ", "시간", "분"], ["", ":",""],  $time_str));
                $result['time_str'] =  $time_str;
                $temp = explode(":", $time_str);
                $minute =  count($temp) == 2 ?  $temp[0] * 60 + $temp[1] : $temp[0];
                $result['total_avg_used_minute'] = $minute;
            }  else if(strpos($row, "사용 일 수") === 0) {
                $avg_use_days = trim(str_replace("사용 일 수", "", $row));
                $result['total_avg_used_days'] = $avg_use_days;
            }

            $result['leak_median'] = $result['중간값'];
            $result['ahi_median'] = $result['중앙'];
        }

        return $result;
    }

    /**
     * 사용시간에 따른 아이콘을 표시한다.
     * 4시간 이상 :  양호
     * 2시간 이상 ~ 4시간 미만 : 보통
     * 2시간 미만 : 주의
     * @param $time_minute
     * @param string $return_type
     * @return void
     */
    public function getStatusByUseTime($time_minute, $return_type = "text", $size="small") {
        $status_icon = [
            "양호" => "my_icon_good.png",
            "보통" => "my_icon_normal.png",
            "주의" => "my_icon_bad.png",
        ];


        $status_class = [
            '양호' => "good",
            '보통' => "normal",
            '주의' => "warn",
        ];


        if(trim($time_minute) == "") return "";

        $status_text = "";
        $low_mid_high = ""; //Low, Mid, High

        if($time_minute >= 4* 60) {
            $status_text = "양호";
            $low_mid_high = "Low";
        } else if( $time_minute >= 2 * 60 && $time_minute < 4*60) {
            $status_text = "보통";
            $low_mid_high = "Mid";
        } else if($time_minute < 2 * 60) {
            $status_text = "주의";
            $low_mid_high = "High";
        } else {
            $status_text =  "";
        }

        if($return_type == "text") {
            return $status_text;
        } else if($return_type == "icon") {
            if($size == "small") {
                return self::$status_icon[$status_text];
            } else if($size == "large") {
                return self::$status_icon_lg[$status_text];
            }
        } else if($return_type == "class") {
            return self::$status_class[$status_text];
        } else if($return_type == "low_mid_high") {
            return $low_mid_high;
        }
    }

    /**
     * Leak(유출)에 따른 아이콘을 표시한다.
     * 24L/min 이하 :  양호
     * 24L/min 초과 : 주의
     * @param $time_minute
     * @return void
     */
    public function getStatusByLeak($leak_median_value, $return_type = "text", $size="small") {


        $status_icon = [
            "양호" => "my_icon_good_lg.png",
            "주의" => "my_icon_bad_lg.png"
        ];


        $status_class = [
            '양호' => "good",
            '보통' => "normal",
            '주의' => "warn",
        ];


        if(trim($leak_median_value) == "") return "";

        $status_text = "";

        if(doubleval($leak_median_value) > 24.0) {
            $status_text = "주의";
        } else if(doubleval($leak_median_value) <= 24.0) {

            $status_text = "양호";
        } else {
            $status_text =  "";
        }

        if($return_type == "text") {
            return $status_text;
        } else if($return_type == "icon") {
            if($size == "small") {
                return self::$status_icon[$status_text];
            } else if($size == "large") {
                return self::$status_icon_lg[$status_text];
            }
        } else if($return_type == "class") {
            return self::$status_class[$status_text];
        }
    }


    /**
     * AHI(무호흡지수)에 따른 아이콘을 표시한다.
     * 24L/min 이하 :  양호
     * 24L/min 초과 : 주의
     * @param $time_minute
     * @return void
     */
    public function getStatusByAHI($ahi_median_value, $return_type = "text", $size="small") {

        $status_icon = [
            "양호" => "my_icon_good.png",
            "보통" => "my_icon_normal.png",
            "주의" => "my_icon_bad.png",
        ];

        $status_class = [
            '양호' => "good",
            '보통' => "normal",
            '주의' => "warn",
        ];

        if(trim($ahi_median_value) == "") return "";

        $status_text = "";

        if(doubleval($ahi_median_value) <= 5.0) {
            $status_text = "양호";
        } else if(doubleval($ahi_median_value) > 5.0 && doubleval($ahi_median_value)  < 15.0) {
            $status_text = "보통";
        } else if(doubleval($ahi_median_value) >= 15.0) {
            $status_text = "주의";
        } else {
            $status_text =  "";
        }

        if($return_type == "text") {
            return $status_text;
        } else if($return_type == "icon") {
            if($size == "small") {
                return self::$status_icon[$status_text];
            } else if($size == "large") {
                return self::$status_icon_lg[$status_text];
            }
        } else if($return_type == "class") {
            return self::$status_class[$status_text];
        }

    }

}
