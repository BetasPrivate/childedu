<?php
class Utility {

	public function customizeCurl($url, $opt=0, $data=[])
    {
        $ch = curl_init();
        if ($opt == 1) {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            $curlDefault = [
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => 300,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPAUTH => CURLAUTH_ANY,
                CURLOPT_FOLLOWLOCATION => TRUE,
            ];
            curl_setopt_array($ch, $curlDefault);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        var_dump($result);
        return $result;
    }
}