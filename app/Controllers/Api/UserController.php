<?php

namespace App\Controllers\Api;

use Framework\AuthTokenController as Controller;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Framework\Response;


class UserController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get($parameters)
    {
        $this->authToken(['Administrador', 'Gerente']);
        $response = new Response();

        try {
            if (isset($parameters['id'])) {
                $users = User::find($parameters['id']);
                $response->json($users->toArray());
            } elseif (isset($_GET['username'])) {
                // Devuelve el primer registro, ya que se busca por una clave única
                $user = User::where('username', $_GET['username'])->get()->first();

                if ($user === null) {
                    $response->json(
                        ["error" => "No se ha encontrado el usuario {$_GET['username']}"],
                        404
                    );
                }
                $response->json($user->toArray());
            } else {
                $users = User::all();
                $response->json($users->toArray());
            }
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAll($parameters)
    {
        $this->authToken(['Administrador', 'Gerente']);
        $response = new Response();

        try {
            if (isset($parameters['id'])) {
                $users = User::with('role')->find($parameters['id']);
                $response->json($users->toArray());
            } elseif (isset($_GET['username'])) {
                // Devuelve el primer registro, ya que se busca por una clave única
                $user = User::with('role')->where('username', $_GET['username'])->get()->first();

                if ($user === null) {
                    $response->json(
                        ["error" => "No se ha encontrado el usuario {$_GET['username']}"],
                        404
                    );
                }
                $response->json($user->toArray());
            } else {
                $users = User::with('role')->get();
                $response->json($users->toArray());
            }
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }

    public function postAll()
    {
        $this->authToken(['Administrador']);
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $user = new User($request);

            if (isset($request['password'])) {
                $user->password = hash('sha256', $request['password']);
            } else {
                throw new \Exception('Contraseña inválida');
            }

            if (isset($request['role']['id'])) {
                $user->roleId = $request['role']['id'];
            } else {
                throw new \Exception('Rol inválido');
            }

            $user->save();
            $response->json($user->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }

    public function put($parameters)
    {
        $userLogged = $this->authToken();
        $request = json_decode(file_get_contents('php://input'), true);
        $response = new Response();

        try {
            $user = User::find($parameters['id']);

            // Si no es el mismo usuario, no tiene permiso, a no ser que sea Administrador o Gerente
            if (!$user->id === $userLogged->id) {
                $this->authToken(['Administrador', 'Gerente']);
            }

            if (isset($request['username']))
                $user->username = $request['username'];

            if (isset($request['name']))
                $user->name = $request['name'];

            if (isset($request['email']))
                $user->email = $request['email'];

            if (isset($request['idCard']))
                $user->idCard = $request['idCard'];

            if (isset($request['password'])){
                // Solo si es administrador puede cambiar la contraseña de otro
                $this->authToken(['Administrador']);
                $user->password = hash('sha256', $request['password']);
            }

            if (isset($request['role']) && $request['role']['id']) {
                // Solo si es administrador puede cambiar el rol
                $this->authToken(['Administrador']);
                $user->roleId = $request['role']['id'];
            }


            $user->save();

            $response->json($user::with('role')->find($user->id)->toArray());
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()]);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()]);
        }
    }

    public function delete($parameters)
    {
        $this->authToken();
        $response = new Response();

        try {
            if (isset($parameters['id'])) {
                $user = User::find($parameters['id']);
                $user->delete();
                $response->json($user->toArray());
            } elseif (isset($_GET['username'])) {
                // Devuelve el primer registro, ya que se busca por una clave única
                $user = User::where('username', $_GET['username'])->get()->first();

                if ($user === null) {
                    $response->json(
                        ["error" => "No se ha encontrado el usuario {$_GET['username']}"],
                        404
                    );
                }
                $user->delete();
                $response->json($user->toArray());
            } else {
                throw new ValidationException('No se ha proporcionado un dato válido');
            }
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }
}
