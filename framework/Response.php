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
            header("Content-Type: application/json");
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
            header("Content-Type: $contentType");
        }

        http_response_code($this->responseCode);

        print_r($content);
        exit();
    }

    public function __construct($responseCode = 200)
    {
        $this->responseCode = $responseCode;

        if (!headers_sent()) {
            if (AppConfiguration::getDebugMode()) {
                header("Access-Control-Allow-Origin: *");
            }
        }
    }
}
