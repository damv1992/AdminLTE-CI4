<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUsuario extends Model
{
    protected $table = 'Usuarios';
    protected $primarykey = 'IdUsuario';
    protected $allowedFields = ['IdUsuario', 'Usuario', 'Contraseña', 'Imagen', 'Telefono', 'RolAsignado'];
}