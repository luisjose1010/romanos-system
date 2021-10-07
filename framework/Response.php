<?php

namespace Framework;

use Framework\View\Render;
use Framework\Configuration\AppConfiguration;

class Response
{
    protected $responseCode;

    public function getResponseCode()
    {
        return $this->responseCode;
    }


    public function json(array $content)
    {
        if (!headers_sent()) {
            header("Content-Type: application/json; charset=UTF-8");
        }

        http_response_code($this->responseCode);

        echo json_encode($content);
        exit();
    }

    public function view(string $view, array $viewParameters = null)
    {
        http_response_code($this->responseCode);

        Render::view($view, $viewParameters);
        exit();
    }

    public function make($content, $contentType)
    {
        if (!headers_sent()) {
            header("Content-Type: $contentType; charset=UTF-8");
        }

        http_response_code($this->responseCode);

        print_r($content);
        exit();
    }

    private function allowCORSRequest()
    {
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }

            exit(0);
        }
    }

    public function __construct($responseCode = 200)
    {
        $this->responseCode = $responseCode;

        if (!headers_sent()) {
            // Permite solicitudes CORS solo en caso de estar en modo de desarrollo
            if (AppConfiguration::getDevelopmentMode()) {
                $this->allowCORSRequest();
            }
        }
    }
}
