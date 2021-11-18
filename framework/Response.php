<?php

namespace Framework;

use Framework\View\Render;
use Framework\Configuration\AppConfiguration;

class Response
{
    public function json(array $content, $responseCode = 200)
    {
        if (!headers_sent()) {
            header("Content-Type: application/json; charset=UTF-8");
        }

        http_response_code($responseCode);

        echo json_encode($content);
        exit();
    }

    public function view(string $view, array $viewParameters = null)
    {
        http_response_code(200);

        Render::view($view, $viewParameters);
        exit();
    }

    public function make($content, $contentType, $responseCode = 200)
    {
        if (!headers_sent()) {
            header("Content-Type: $contentType; charset=UTF-8");
        }

        http_response_code($responseCode);

        print_r($content);
        exit();
    }

    public function __construct(bool $showErrors = true)
    {
        if (!$showErrors) {
            error_reporting(0);
            ini_set('display_errors', 0);
        }
    }
}
