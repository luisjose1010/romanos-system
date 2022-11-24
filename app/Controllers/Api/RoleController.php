<?php

namespace App\Controllers\Api;

use Framework\Controller;
use App\Models\Role;
use Framework\Response;


class RoleController extends Controller
{
    public function index(array $parameters = null)
    {
    }

    public function get($parameters)
    {
        $response = new Response();

        try {
            if (isset($parameters['id'])) {
                $users = Role::find($parameters['id']);
                $response->json($users->toArray());
            } else {
                $users = Role::all();
                $response->json($users->toArray());
            }
        } catch (\Exception $e) {
            $response->json(["error" => $e->getMessage()], 500);
        } catch (\Error $e) {
            $response->json(['error' => $e->getMessage()], 500);
        }
    }
}
