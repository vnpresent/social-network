<?php
namespace App\Interfaces;

use App\Models\User;

interface PostRepositoryInterface
{
    public function index();
    public function create(array $data);
    public function show($id);
    public function update($id,array $data);
}
