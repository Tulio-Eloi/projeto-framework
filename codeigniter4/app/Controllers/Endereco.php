<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Endereco as Endereco_model;
use App\Models\Cidades as Cidade_model;

class Endereco extends BaseController
{
    private $endereco;
    private $cidade;
    public function __construct(){
        $this->endereco = new  Endereco_model(); // instancia do model
        $this->cidade = new Cidade_model();

        $data['title'] = 'Endereços';
        helper('functions'); // chama os metodos auxiliares
    }
    public function index()
    {
        $data['title'] = 'Endereços';
        $data['op'] = 'create';
        $data['form'] = 'cadastrar';
        //$data['cidade'] = $this->cidades->findAll();
     

        return view('endereco/index', $data);
    }
}
