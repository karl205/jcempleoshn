<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    protected $guard_name = 'api';

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
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
        return $this->belongsToMany(
            Rol::class,
            'usuarios_roles',
            'usuario_id',
            'rol_id'
        );
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'usuario_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers de Roles
    |--------------------------------------------------------------------------
    */

    public function tieneRol(string $rol): bool
    {
        return $this->roles()
            ->where('nombre', $rol)
            ->exists();
    }

    // Alias para middleware
    public function hasRole(string $rol): bool
    {
        return $this->tieneRol($rol);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers de Permisos
    |--------------------------------------------------------------------------
    */

    public function tienePermiso(string $permiso): bool
    {
        $permisos = Cache::remember(
            "user_permissions_{$this->id}",
            now()->addMinutes(60),
            function () {

                return DB::table('usuarios_roles as ur')
                    ->join('roles_permisos as rp', 'rp.rol_id', '=', 'ur.rol_id')
                    ->join('permisos as p', 'p.id', '=', 'rp.permiso_id')
                    ->where('ur.usuario_id', $this->id)
                    ->pluck('p.nombre')
                    ->toArray();

            }
        );

        return in_array($permiso, $permisos);
    }

    public function limpiarCachePermisos()
    {
        Cache::forget("user_permissions_{$this->id}");
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers útiles
    |--------------------------------------------------------------------------
    */

    public function getRoles()
    {
        return Cache::remember(
            "user_roles_{$this->id}",
            now()->addMinutes(60),
            fn() => $this->roles()->pluck('nombre')
        );
    }

    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }

    /*
    |--------------------------------------------------------------------------
    | Auth Config
    |--------------------------------------------------------------------------
    */

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}