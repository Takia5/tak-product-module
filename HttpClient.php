<?php

namespace HttpClient;

/**
 * Interface for HTTP client implementations
 */
interface HttpClientInterface
{
    /**
     * Send an HTTP request to the specified URL
     *
     * @param string $method The HTTP method (e.g. POST, PUT, etc.)
     * @param string $apiUrl The URL to send the request to
     * @param mixed $data Data to be sent with the request
     * @return string The response data from the server
     */
    public function requestApi(string $method, string $apiUrl, $data): string;
}

/**
 * HTTP client implementation using cURL
 */
class HttpClient implements HttpClientInterface
{
    /**
     * Send an HTTP request to the specified URL
     *
     * @param string $method The HTTP method (e.g. POST, PUT, etc.)
     * @param string $apiUrl The URL to send the request to
     * @param mixed $data Data to be sent with the request
     * @return string The response data from the server
     */
    public function requestApi(string $method, string $apiUrl, $data): string
    {
        $curl = curl_init();
        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            default:
                if ($data) {
                    $apiUrl = sprintf("%s?%s", $apiUrl, http_build_query($data));
                }
        }
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'APIKEY: HYU670',
            'Content-Type: application/json',
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $resultData = curl_exec($curl);
        if(!$resultData){
            die("Invalid API Request!");
        }
        curl_close($curl);
        return $resultData;
    }
}
