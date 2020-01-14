<?php
namespace App\Helpers;

class Curl {
    private $http_code;
    private $error;
    private $access_token;

    public function __construct() {
        $this->http_code = -1;
        $this->error = "";
    }

    public function setAccessToken($access_token) {
        $this->access_token = $access_token;
    }

    public function getHttpCode() {
        return $this->http_code;
    }

    public function getError() {
        return $this->error;
    }

    public function httpGet($url) {
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_NOBODY => true,
            CURLOPT_ENCODING => "",
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer '. $this->access_token
            ),
        ));
         curl_setopt($ch,CURLOPT_HEADER, false);

        $output=curl_exec($ch);
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $err = curl_errno($ch);
        if($err) {
            $this->$http_code = $http_code;
            $this->error = $err;
            return $err;
        }
        curl_close($ch);
        return $output;
    }

    public function httpPost($url, $fields) {
//        var_dump(http_build_query($fields));exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        if($this->access_token !== null || $this->access_token != '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Accept: application/json',
//                'Content-Type: application/json',
                'Authorization: Bearer '. $this->access_token,
            ]);
        }
        else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Accept: application/json',
            ]);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output=curl_exec($ch);
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $err = curl_errno($ch);
        if($err) {
            $this->$http_code = $http_code;
            $this->error = $err;
            return $err;
        }
        curl_close($ch);
        return $output;
    }

    public function httpPut($url, $fields) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer '. $this->access_token
        ]);

        $output=curl_exec($ch);
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $err = curl_errno($ch);
        if($err) {
            $this->$http_code = $http_code;
            $this->error = $err;
            return $err;
        }
        curl_close($ch);
        return $output;
    }
}
