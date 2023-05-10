<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPagina extends Model
{
    protected $table = 'Pagina';
    protected $allowedFields = ['Nombre', 'Imagen'];
}