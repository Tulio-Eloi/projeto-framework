<?php

namespace App\Models;

use CodeIgniter\Model;

class Estoque extends Model
{
    protected $table = 'estoques';
    protected $primaryKey = 'id';
    protected $allowedFields = ['produto_id', 'quantidade'];

    protected $useTimestamps = false;
}
