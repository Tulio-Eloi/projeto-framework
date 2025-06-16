<?php

namespace App\Models;

use CodeIgniter\Model;
helper('functions');

class PedidoItem extends Model {
    protected $table = 'pedidos_itens';
    protected $primaryKey = 'item_id';
    protected $allowedFields = ['pedido_id', 'produto_id', 'quantidade', 'preco_unitario'];
    protected $returnType = 'object';

    public $item_id;
    public $pedido_id;
    public $produto_id;
    public $quantidade;
    public $preco_unitario;

}
