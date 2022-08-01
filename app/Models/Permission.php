<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'key_list',
    ];

    public function permissionchilds()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}
