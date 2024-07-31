<?php

namespace App\HTTP;

require_once "vendor/autoload.php";

class AnkiConnection
{
    private static HttpClient $HttpConnection; // Hardcoded in the init method for simplicity
    private static array $postData;
    const URL = "http://localhost:8765/";
    const VERSION = 6;

    public static function init(): void
    {
        self::$HttpConnection = new HttpClient();
        self::$postData['version'] = self::VERSION;
        self::$HttpConnection->setUpRequest(self::URL, "POST");
    }

    public static function getVersion(): int
    {
        // TODO: Implement getVersion() method. (Send a request to the server with the version action then setting it to the constant)
        return self::VERSION;
    }

    public static function setAction($action)
    {
        self::$postData['action'] = $action;
        return __CLASS__;
    }

    public static function setParams(array $params)
    {
        self::$postData['params'] = $params;
        return __CLASS__;
    }

    public static function invoke(string $action, array $params = [])
    {
        return self::setAction($action)::setParams($params)::execute();
    }

    // Executes the specified action
    public static function execute()
    {
        self::$HttpConnection->setPostData(self::$postData);

        $response = self::$HttpConnection->execute();

        $action = self::$postData["action"]; // Remember the action

        // Clear custom request parameters for future operations
        self::$postData['params'] = [];
        self::$postData['action'] = "";

        self::checkForErrors($response, $action);

        return $response['result'];
    }

    private static function checkForErrors($response, $action)
    {
        // The following are standard error checking conditions stated in the Anki connect documentation
        try {
            if (count($response) !== 2) {
                throw new \Exception("Response has an unexpected number of fields");
            } elseif (!array_key_exists('result', $response)) {
                throw new \Exception("Response is missing required result field");
            } elseif (!array_key_exists('error', $response)) {
                throw new \Exception("Response is missing required error field");
            } elseif ($response['error'] !== null) {
                throw new \Exception($response['error']);
            } else {
                echo "Action $action completed successfully" . PHP_EOL;
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
