<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // Permisos del usuario
        $permisos = DB::table('usuarios_roles as ur')
            ->join('roles_permisos as rp', 'rp.rol_id', '=', 'ur.rol_id')
            ->join('permisos as p', 'p.id', '=', 'rp.permiso_id')
            ->where('ur.usuario_id', $userId)
            ->pluck('p.nombre')
            ->toArray();

        // Definición de módulos del menú
        $menu = [

            [
                'label' => 'Dashboard',
                'path' => '/admin',
                'icon' => 'FaTachometerAlt',
                'permiso' => 'ver_dashboard',
            ],

            [
                'label' => 'Usuarios',
                'path' => '/admin/usuarios',
                'icon' => 'FaUsers',
                'permiso' => 'usuarios.ver',
            ],

            [
                'label' => 'Roles',
                'path' => '/admin/roles',
                'icon' => 'FaUserShield',
                'permiso' => 'roles.ver',
            ],

            [
                'label' => 'Permisos',
                'path' => '/admin/permisos',
                'icon' => 'FaKey',
                'permiso' => 'permisos.ver',
            ],

            [
                'label' => 'Plazas',
                'path' => '/admin/plazas',
                'icon' => 'FaBriefcase',
                'permiso' => 'plazas.ver',
            ],

            [
                'label' => 'Postulaciones',
                'path' => '/admin/postulaciones',
                'icon' => 'FaUserCheck',
                'permiso' => 'postulaciones.ver',
            ],

            [
                'label' => 'Comentarios',
                'path' => '/admin/testimonios',
                'icon' => 'FaComments',
                'permiso' => 'testimonios.ver',
            ],

            [
                'label' => 'Bitácora',
                'path' => '/admin/bitacora',
                'icon' => 'FaClipboardList',
                'permiso' => 'bitacora.ver',
            ],

            [
                'label' => 'Backups',
                'path' => '/admin/backups',
                'icon' => 'FaDatabase',
                'permiso' => 'backups.ver',
            ],

            [
                'label' => 'Mantenimientos',
                'icon' => 'FaTools',
                'children' => [

                    [
                        'label' => 'Actividades laborales',
                        'path' => '/admin/mantenimientos/actividades-laborales',
                        'icon' => 'FaTasks',
                        'permiso' => 'actividades_laborales.ver'
                    ],

                    [
                        'label' => 'Áreas de estudio',
                        'path' => '/admin/mantenimientos/areas-estudio',
                        'icon' => 'FaBook',
                        'permiso' => 'areas_estudio.ver'
                    ],

                    [
                        'label' => 'Cargos laborales',
                        'path' => '/admin/mantenimientos/cargos-laborales',
                        'icon' => 'FaUserTie',
                        'permiso' => 'cargos_laborales.ver'
                    ],

                    [
                        'label' => 'Categorías laborales',
                        'path' => '/admin/mantenimientos/categorias-laborales',
                        'icon' => 'FaLayerGroup',
                        'permiso' => 'categorias_laborales.ver'
                    ],

                    [
                        'label' => 'Ciudades',
                        'path' => '/admin/mantenimientos/ciudades',
                        'icon' => 'FaCity',
                        'permiso' => 'ciudades.ver'
                    ],

                    [
                        'label' => 'Departamentos',
                        'path' => '/admin/mantenimientos/departamentos',
                        'icon' => 'FaMap',
                        'permiso' => 'departamentos.ver'
                    ],

                    [
                        'label' => 'Disponibilidad vehicular',
                        'path' => '/admin/mantenimientos/disponibilidad-vehicular',
                        'icon' => 'FaCar',
                        'permiso' => 'disponibilidad_vehicular.ver'
                    ],

                    [
                        'label' => 'Idiomas',
                        'path' => '/admin/mantenimientos/idiomas',
                        'icon' => 'FaLanguage',
                        'permiso' => 'idiomas.ver'
                    ],

                    [
                        'label' => 'Nacionalidades',
                        'path' => '/admin/mantenimientos/nacionalidades',
                        'icon' => 'FaFlag',
                        'permiso' => 'nacionalidades.ver'
                    ],

                    [
                        'label' => 'Niveles educativos',
                        'path' => '/admin/mantenimientos/niveles-educativos',
                        'icon' => 'FaGraduationCap',
                        'permiso' => 'niveles_educativos.ver'
                    ],

                    [
                        'label' => 'Niveles idioma',
                        'path' => '/admin/mantenimientos/niveles-idioma',
                        'icon' => 'FaComments',
                        'permiso' => 'niveles_idioma.ver'
                    ],

                    [
                        'label' => 'Países',
                        'path' => '/admin/mantenimientos/paises',
                        'icon' => 'FaGlobe',
                        'permiso' => 'paises.ver'
                    ],

                    [
                        'label' => 'Sexos',
                        'path' => '/admin/mantenimientos/sexos',
                        'icon' => 'FaVenusMars',
                        'permiso' => 'sexos.ver'
                    ],
                ]
            ],
        ];

        //Filtrar menú por permisos
        $menuFiltrado = array_values(array_filter($menu, function ($item) use ($permisos) {

            // si tiene hijos (grupo)
            if (isset($item['children'])) {
                $item['children'] = array_values(array_filter($item['children'], function ($child) use ($permisos) {
                    return in_array($child['permiso'], $permisos);
                }));

                return count($item['children']) > 0;
            }

            return in_array($item['permiso'], $permisos);
        }));

        return response()->json([
            'success' => true,
            'data' => $menuFiltrado,
        ]);
    }
}