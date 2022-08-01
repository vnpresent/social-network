<?php
namespace App\Interfaces;


interface PermissionRepositoryInterface
{
    public function index();
    public function create(array $data);
}
