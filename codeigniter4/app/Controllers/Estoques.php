<?php

namespace App\Controllers;

use App\Models\Estoque;
use App\Models\Produtos;

helper('functions');

class Estoques extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('estoques');
        $builder->select('estoques.*, produtos.produtos_nome');
        $builder->join('produtos', 'produtos.produtos_id = estoques.produto_id');
        $query = $builder->get();

        $data['estoques'] = $query->getResult();
        $data['title'] = 'Estoque';

        return view('estoques/index', $data);
    }

    public function edit($id)
    {
        $model = new Estoque();
        $db = \Config\Database::connect();
        $builder = $db->table('estoques');
        $builder->select('estoques.*, produtos.produtos_nome');
        $builder->join('produtos', 'produtos.produtos_id = estoques.produto_id');
        $builder->where('estoques.id', $id);
        $query = $builder->get();

        $data['estoque'] = $query->getRow();
        $data['title'] = 'Estoque';
        $data['form'] = 'editar';
        $data['op'] = 'update';

        return view('estoques/form', $data);
    }

    public function update()
    {
        $model = new Estoque();
        $id = $this->request->getPost('id');
        $quantidade = $this->request->getPost('quantidade');

        $model->update($id, [
            'quantidade' => $quantidade
        ]);

        return redirect()->to('/estoques')->with('msg', \msg('Estoque atualizado com sucesso!', 'success'));
    }
}

