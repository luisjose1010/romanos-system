<?php

namespace Framework;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\ExpiredException;
use UnexpectedValueException;
use Exception;
use Error;
use DateTimeImmutable;
use Framework\Configuration\AppConfiguration;

abstract class AuthTokenController extends Controller
{
    public function authToken(array $roles = [])
    {
        $response = new Response();
        $result = null;
        $authorized = false;

        try {
            if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
                if (preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
                    $token = $matches[1];

                    $result = $this->checkToken($token);

                    foreach ($roles as $key) {
                        if ($result['role']['name'] === $key) {
                        }
                    }
                } else {
                    throw new UnexpectedValueException;
                }
            } else {
                throw new UnexpectedValueException;
            }

            if (count($roles) > 0 && !$authorized) {
                throw new Exception('Usuario no autorizado para acceder al recurso');
            }
        } catch (SignatureInvalidException $e) {
            $response->json(['error' => 'Firma incorrecta de token'], 401);
        } catch (ExpiredException $e) {
            $response->json(['error' => 'Token expirado'], 401);
        } catch (UnexpectedValueException $e) {
            $response->json(['error' => 'Token inválido'], 401);
        } catch (Exception $e) {
            $response->json(['error' => $e->getMessage()], 401);
        } catch (Error $e) {
            $response->json(['error' => 'Error al procesar token'], 500);
        }

        return $result;
    }

    protected function checkToken($token)
    {
        $secretKey = $_ENV['API_SECRET_KEY'];

        return JWT::decode($token, new Key($secretKey, 'HS256'));
    }

    protected function createToken(array $user): string
    {
        $secretKey = $_ENV['API_SECRET_KEY'];
        $issuedAt = new DateTimeImmutable();
        $expire = $issuedAt->modify("+{$_ENV['API_TOKEN_EXPIRES']} milliseconds")->getTimestamp();
        $serverName = $_ENV['APP_SERVER'];

        $payload = [
            'iat'  => $issuedAt->getTimestamp(),
            'iss'  => $serverName,
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expire,
            'id' => $user['id'],
            'username' => $user['username'],
            'name' => $user['name'],
            'idCard' => $user['idCard'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        return JWT::encode($payload, $secretKey, 'HS256');
    }
}