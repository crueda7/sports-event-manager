<?php

declare(strict_types=1);

return [
    'roles' => [
        'module' => 'Rol',
        'title' => 'Roles',
        'title_create' => 'Crear rol',
        'title_edit' => 'Editar rol',
        'title_delete' => 'Eliminar rol',
        'delete_confirmation_title' => '¿Está seguro de que desea eliminar este rol?',
        'delete_confirmation_description' => 'Asegúrese de que el rol a eliminar no está asociado a ningún usuario, será eliminado permanentemente.',
        'breadcrumb' => 'Roles',
        'id' => 'Id',
        'name' => 'Nombre',
        'actions' => 'Acciones',
    ],
    'users' => [
        'module' => 'Usuario',
        'title' => 'Usuarios',
        'title_create' => 'Crear usuario',
        'title_edit' => 'Editar usuario',
        'title_delete' => 'Eliminar usuario',
        'delete_confirmation_title' => '¿Está seguro de que desea eliminar este usuario?',
        'delete_confirmation_description' => 'Una vez que este usuario es eliminado, todos sus recursos y datos también serán eliminados permanentemente.',
        'breadcrumb' => 'Usuarios',
        'id' => 'Id',
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'role' => 'Rol',
        'select_role' => 'Seleccione un rol',
        'password' => 'Contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'actions' => 'Acciones',
    ],
];
