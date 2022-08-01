<?php


namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class  RoleRepository implements RoleRepositoryInterface
{
    public function index()
    {
        return Role::all();
    }

    public function create(array $data)
    {
        $role = Role::create($data);
        $role->permissions()->attach($data['permissions_id']);
        $role['permissions'] = $role->permissions;
        return $role;
    }

    public function show($id)
    {
        $role = Role::find($id)->first();
        $role['permissions'] = $role->permissions;
        return $role;
    }

    public function update($id,array $data)
    {
        $role = Role::find($id);
        $role->update($data);
        $role->permissions()->sync($data['permissions_id']);
        $role['permissions'] = $role->permissions;
        return $role;
    }
}
