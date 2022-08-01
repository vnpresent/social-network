<?php
namespace App\Interfaces;

use App\Models\User;

interface CommentRepositoryInterface
{
    public function create(array $data);
    public function update($id,array $data);
    public function delete(array $data);
}
