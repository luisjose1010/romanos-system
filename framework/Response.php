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

    public function setResponseCode(int $responseCode)
    {
        $this->responseCode = $responseCode;
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

    public function __construct($responseCode = 200)
    {
        error_reporting(0);
        ini_set('display_errors', 0);

        $this->responseCode = $responseCode;
    }
}
