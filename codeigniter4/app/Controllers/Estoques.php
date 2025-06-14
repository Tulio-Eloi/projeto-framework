<?php

namespace App\Controllers;

use App\Models\Estoque;
use App\Models\Produtos;

class Estoques extends BaseController
{
    public function index()
    {
        $model = new Estoque();
        $data['estoques'] = $model->join('produtos', 'produtos.produtos_id = estoques.produto_id')
                                  ->select('estoques.*, produtos.produtos_nome as produto_nome')
                                  ->findAll();
        return view('estoques/index', $data);
    }

    public function create()
    {
        $produtosModel = new Produtos();
        $data['produtos'] = $produtosModel->findAll();

        if ($this->request->getMethod() === 'post') {
            $model = new Estoques();
            $model->save([
                'produto_id' => $this->request->getPost('produto_id'),
                'quantidade' => $this->request->getPost('quantidade')
            ]);
            return view('estoques/form', $data);
        }
    }

    public function edit($id)
    {
        $model = new Estoques();
        $estoque = $model->find($id);
        if (!$estoque) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Estoque não encontrado: ' . $id);
        }

        $produtosModel = new Produtos();
        $data['produtos'] = $produtosModel->findAll();
        $data['estoque'] = $estoque;

        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'produto_id' => $this->request->getPost('produto_id'),
                'quantidade' => $this->request->getPost('quantidade')
            ]);
            return view('estoques/form', $data);
        }

    }

    public function delete($id)
    {
        $model = new Estoques();
        $model->delete($id);
        return view('estoques/index', $data);
    }
}
