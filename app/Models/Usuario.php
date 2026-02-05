<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //  Relaciones

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

    // Helpers de Roles y Permisos

    public function tieneRol(string $rol): bool
    {
        return $this->roles()
            ->where('nombre', $rol)
            ->exists();
    }

    public function tienePermiso(string $permiso): bool
    {
        return DB::table('permisos')
            ->join('roles_permisos', 'permisos.id', '=', 'roles_permisos.permiso_id')
            ->join('usuarios_roles', 'roles_permisos.rol_id', '=', 'usuarios_roles.rol_id')
            ->where('usuarios_roles.usuario_id', $this->id)
            ->where('permisos.nombre', $permiso)
            ->exists();
    }

    //  * Devuelve la contraseña para Auth (usa password)
    public function getAuthPassword()
    {
        return $this->password;
    }

    //  * Campo usado para autenticación (email)
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    //  * Para enviar correos
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    //  * Campo que se usa para reset de contraseña
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}
