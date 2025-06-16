<?php

namespace App\Models;
use CodeIgniter\Model;

helper('functions');

class Pedido extends Model {
    protected $table = 'pedidos';
    protected $primaryKey = 'pedido_id';
    protected $allowedFields = ['cliente_id', 'endereco_id', 'data_pedido', 'status'];
    protected $returnType = 'object';

    public $pedido_id;
    public $cliente_id;
    public $endereco_id;
    public $data_pedido;
    public $status;

    
    public $itens = []; 


}
