<?php

namespace App\Controllers\Api;

use Framework\AuthTokenController as Controller;
use Framework\Response;
use App\Models\User;

class AuthController extends Controller
{
    private string $name = '';
    private int $id = 0;
    private string $idCard = '';
    private string $email = '';
    private array $role = [];

    public function index($parameters = null)
    {
        $response = new Response();

        try {
            if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
                $username = $_SERVER['PHP_AUTH_USER'];
                $password = $_SERVER['PHP_AUTH_PW'];

                if ($this->login($username, $password)) {
                    $response->json([
                        'id' => $this->id,
                        'username' => $username,
                        'name' => $this->name,
                        'idCard' => $this->idCard,
                        'email' => $this->email,
                        'role' => $this->role,
                        'token' => $this->createToken([
                            'id' => $this->id,
                            'username' => $username,
                            'name' => $this->name,
                            'idCard' => $this->idCard,
                            'email' => $this->email,
                            'role' => $this->role
                        ])
                    ]);
                } else {
                    $response->json(['error' => 'Usuario o contraseña incorrectos'], 401);
                }
            } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
                $this->refreshToken();
            } else {
                $response->json(['error' => 'Datos incompletos'], 401);
            }
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }

    public function refreshToken()
    {
        $tokenContent = $this->authToken();

        $response = new Response();

        try {
            $response->json([
                'username' => $tokenContent->username,
                'name' => $tokenContent->name,
                'role' => $tokenContent->role,
                'token' => $this->createToken(
                    $tokenContent->username,
                    $tokenContent->name,
                    $tokenContent->role
                )
            ]);
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }

    private function login(string $username, string $password): bool
    {
        $authenticated = false;
        // Devuelve el primer registro, ya que se busca por una clave única
        $user = User::where('username', $username)->get()->first();

        if (isset($user)) {
            if ($user->username === $username && $user->password === hash('sha256', $password)) {
                // Se guardan los datos relevantes para la autententicación y especialmente el token
                $this->id = $user->id;
                $this->username = $user->username;
                $this->name = $user->name;
                $this->idCard = $user->idCard;
                $this->email = $user->email;
                $this->role = ['id' => $user->role->id, 'name' => $user->role->name];

                $authenticated = true;
            }
        }

        return $authenticated;
    }
}
