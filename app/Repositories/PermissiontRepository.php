<?php


namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class  PermissiontRepository implements PermissionRepositoryInterface
{
    public function index()
    {
        return Permission::all();
    }
    public function create(array $data)
    {
        return Permission::create($data);
    }
}
