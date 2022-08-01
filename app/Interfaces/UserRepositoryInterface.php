<?php
namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function index();
    public function me();
    public function update($name);
}
