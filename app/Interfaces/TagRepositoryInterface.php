<?php
namespace App\Interfaces;

use App\Models\User;

interface TagRepositoryInterface
{
    public function create(array $values);
    public function findByName(array $names);
    public function search($tag);
}
