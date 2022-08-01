<?php


namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;

class  UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        return User::all();
    }

    public function me()
    {
        return auth()->user();
    }
    public function update($name)
    {
        auth()->user()->update(['name'=>$name]);
        return auth()->user();
    }
}
