<?php
namespace App\Interfaces;

use App\Models\User;

interface AdminRepositoryInterface
{
    public function index();
    public function update($id,array $data);
    public function delete($id);
}
