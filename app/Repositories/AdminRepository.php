<?php


namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\User;

class  AdminRepository implements AdminRepositoryInterface
{
    public function index()
    {
        return User::all();
    }

    public function create(array $data)
    {

    }

    public function show($id)
    {

    }

    public function update($id,array $data)
    {
        $user = User::find($id);
        $user->roles()->sync($data['roles']);
        $user['roles'] = $user->roles;
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
