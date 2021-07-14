<?php
/**
 * Connect to API
 */
class rest_api {

    private $apikey = "APIKEY_HASH";
    private $url = "http://localhost/LibraryAPI/api/index.php";

    /**
     * 
     * @param type $action this is an Endpoint action
     * @param type $data this is details of API that we need on API server for example informations Tables
     * @return type this is an answer from Server for example data or error code
     */
    function getData($action, $data = array()) {
        $curl = curl_init();
        $data['apikey'] = $this->apikey;
        $data['action'] = strtoupper($action);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);
        $result_data = json_decode($result);
        return $result_data;
    }

}
