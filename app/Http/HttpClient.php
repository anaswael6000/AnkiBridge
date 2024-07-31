<?php

declare (strict_types = 1);

namespace App\Http;

// A cURL http client class
class HttpClient
{
    public $handle;
    public array $headers = [];
    // const CONTENT_TYPE = "application/json";

    public function __construct()
    {
        $this->handle = curl_init();
        // $this->headers[] = "Content-Type:" . self::CONTENT_TYPE;
    }

    public function setUpRequest(string $url, string $method)
    {
        $method = trim(strtoupper($method));
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ];

        if ($method == "POST") {
            $options[CURLOPT_POST] = true;
        }
        curl_setopt_array($this->handle, $options);
    }

    public function setPostData(array $postData)
    {
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, json_encode($postData));
        return $this;
    }

    public function addHttpHeader(string $header)
    {
        $this->headers[] = $header;
        return $this;
    }

    // Executes the HTTP request and returns the response
    public function execute()
    {
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $this->headers);
        $result = curl_exec($this->handle);
        if (($error = curl_error($this->handle)) == true) {
            exit($error);
        }

        return json_decode($result, true);
    }
}
