<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Exception;

class  AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        try {
            $user = User::create(array_merge($data, ['password' => bcrypt($data['password'])]));
            return ['success' => true, 'data' => [
                'message' => 'User successfully registered',
                'data' => $user
            ]];
        } catch (Exception $ex) {
            return ['success' => false, 'data' => [
                'message' => 'user exsist',
                'data' => null
            ]];
        }
    }

    public function login(array $data)
    {
        if ($token = auth()->attempt($data)) {
            return ['success' => true,
                'message' => 'login successfull',
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60
                ]];
        } else {
            return ['success' => false,
                'message' => 'email or password incorrect',
                'data' => [
                    'access_token' => null,
                    'token_type' => null,
                    'expires_in' => null]];
        }
    }

    public function logout()
    {
        auth()->logout();
        return ['success' => true,
            'message' => 'logout',
            'data' => null];
    }

    public function refresh()
    {
        return ['success' => true,
            'message' => 'refesh successfull',
            'data' => [
                'access_token' => auth()->refresh(),
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]];

    }
}
