<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers de Roles y Permisos
    |--------------------------------------------------------------------------
    */

    public function hasRole(string $role): bool
    {
        return $this->roles()
            ->where('name', $role)
            ->exists();
    }

    public function hasPermission(string $permission): bool
    {
        return DB::table('permissions')
            ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->join('user_roles', 'role_permissions.role_id', '=', 'user_roles.role_id')
            ->where('user_roles.user_id', $this->id)
            ->where('permissions.name', $permission)
            ->exists();
    }

    //RELACION PROFILE
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
