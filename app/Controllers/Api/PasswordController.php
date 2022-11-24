<?php

namespace App\Controllers\Api;

use Framework\AuthTokenController as Controller;
use Framework\Response;
use App\Models\User;

class PasswordController extends Controller
{
    public function index($parameters = null)
    {
    }

    public function post()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $password = $this->generatePassword();

        $user = User::where('username', $request['username'])->get()->first();
        $user->password = hash('sha256', $password);
        $user->save();

        $message = "La contrasena temporal asignada al reestablecer es: $password";

        // Enviar por correo contraseña temporal
        mail($user->email, 'Recuperacion de contrasena', $message);

        $response = new Response();
        $response->json($user->toArray());
    }

    private function generatePassword()
    {
        $key = "";
        $length = 5;
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $length; $i++) {
            $key .= substr($pattern, mt_rand(0, $max), 1);
        }
        return $key;
    }
}
