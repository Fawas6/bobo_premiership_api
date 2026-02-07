<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $guarded = [];

    public static function getAdminRoleId()
    {
        return env('ADMIN_ROLE_ID', 1);
    }

    public function permissions()
    {
        return $this->hasMany(Permmission::class, 'role_id');
    }
}
