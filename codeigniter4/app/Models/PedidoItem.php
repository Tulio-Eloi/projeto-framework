<?php

namespace App\Models;

use CodeIgniter\Model;
helper('functions');

class PedidoItem {
    public $item_id;
    public $pedido_id;
    public $produto_id;
    public $quantidade;
    public $preco_unitario;

    public function __construct($dados = []) {
        foreach ($dados as $chave => $valor) {
            $this->$chave = $valor;
        }
    }
}
