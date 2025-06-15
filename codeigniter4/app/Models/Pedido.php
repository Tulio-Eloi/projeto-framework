<?php

namespace App\Models;



helper('functions');

class Pedido {
    public $pedido_id;
    public $cliente_id;
    public $endereco_id;
    public $data_pedido;
    public $status;

    
    public $itens = []; 

    public function __construct($dados = []) {
        foreach ($dados as $chave => $valor) {
            $this->$chave = $valor;
        }
    }
}
