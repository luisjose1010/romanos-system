<?php

namespace App\Controllers\Api;

use Framework\AuthTokenController as Controller;
use Framework\Response;
use App\Models\User;

class BackupController extends Controller
{
    public function index($parameters = null)
    {
    }

    public function post()
    {
        $response = new Response();

        try {
            $this->createBackup();
            $response->json(['info' => 'Copia de seguridad creada']);
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }

    private function createBackup()
    {
    }
}
