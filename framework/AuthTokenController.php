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
    public function authToken()
    {
        $response = new Response();
        $result = null;

        try {
            if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
                if (preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
                    $token = $matches[1];

                    $result = $this->checkToken($token);
                } else {
                    throw new UnexpectedValueException;
                }
            } else {
                throw new UnexpectedValueException;
            }
        } catch (SignatureInvalidException $e) {
            $response->json(['error' => 'Firma incorrecta de token'], 401);
        } catch (ExpiredException $e) {
            $response->json(['error' => 'Token expirado'], 401);
        } catch (UnexpectedValueException $e) {
            $response->json(['error' => 'Token inválido'], 401);
        } catch (Exception $e) {
            $response->json(['error' => 'Error al procesar token'], 401);
        } catch (Error $e) {
            $response->json(['error' => 'Error al procesar token'], 401);
        }

        return $result;
    }

    protected function checkToken($token)
    {
        $secretKey = $_ENV['API_SECRET_KEY'];

        return JWT::decode($token, new Key($secretKey, 'HS256'));
    }

    protected function createToken($username, $name, $role): string
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
            'username' => $username,
            'name' => $name,
            'role' => $role
        ];

        return JWT::encode($payload, $secretKey, 'HS256');
    }
}
