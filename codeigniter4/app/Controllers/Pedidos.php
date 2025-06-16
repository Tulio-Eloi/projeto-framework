<?php

namespace App\Controllers;


use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Cliente;
use App\Models\Produtos;
use App\Models\Endereco;

helper('functions');

class Pedidos extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pedidos');
        $builder->select('pedidos.*, clientes.nome_cliente, clientes.fone_cliente');
        $builder->join('clientes', 'clientes.id_clientes = pedidos.cliente_id');
        $query = $builder->get();

        $data['pedidos'] = $query->getResult();
        $data['title'] = 'Pedidos';

        return view('pedidos/index', $data);
    }

    public function create()
    {
        $clientesModel = new Cliente();
        $produtosModel = new Produtos();
        $enderecoModel = new Endereco();

        $data['clientes'] = $clientesModel->findAll();
        $data['produtos'] = $produtosModel->findAll();
        $data['enderecos'] = $enderecoModel->findAll();
        $data['title'] = 'Novo Pedido';
        $data['form'] = 'criar';
        $data['op'] = 'store';

        return view('pedidos/form', $data);
    }

    public function store()
    {
        $pedidoModel = new Pedido();
        $pedidoItensModel = new PedidoItem();

        $pedidoData = [
            'cliente_id' => $this->request->getPost('cliente_id'),
            'endereco_id' => $this->request->getPost('endereco_id'),
            'data_pedido' => date('Y-m-d H:i:s'),
            'status_pedido' => $this->request->getPost('status_pedido'),
        ];

        $pedido_id = $pedidoModel->insert($pedidoData);

        $produtos = $this->request->getPost('produtos'); // array de produto_id
        $quantidades = $this->request->getPost('quantidades'); // array de quantidade

        foreach ($produtos as $key => $produto_id) {
            $produtoModel = new Produtos();
            $produto = $produtoModel->find($produto_id);

            $pedidoItensModel->insert([
                'pedido_id' => $pedido_id,
                'produto_id' => $produto_id,
                'quantidade' => $quantidades[$key],
                'preco_venda' => $produto->produtos_preco_venda
            ]);
        }

        return redirect()->to('/pedidos')->with('msg', \msg('Pedido criado com sucesso!', 'success'));
    }

    public function edit($id)
    {
        $pedidoModel = new Pedido();
        $pedidoItensModel = new PedidoItem();
        $clientesModel = new Cliente();
        $produtosModel = new Produtos();
        $enderecoModel = new Endereco();

        $pedido = $pedidoModel->find($id);
        $pedidoItens = $pedidoItensModel->where('pedido_id', $id)->findAll();

        $data['pedido'] = $pedido;
        $data['pedido_itens'] = $pedidoItens;
        $data['clientes'] = $clientesModel->findAll();
        $data['produtos'] = $produtosModel->findAll();
        $data['enderecos'] = $enderecoModel->findAll();
        $data['title'] = 'Editar Pedido';
        $data['form'] = 'editar';
        $data['op'] = 'update';

        return view('pedidos/form', $data);
    }

    public function update()
    {
        $pedidoModel = new Pedido();
        $pedidoItensModel = new PedidoItem();

        $pedido_id = $this->request->getPost('pedido_id');

        $pedidoData = [
            'cliente_id' => $this->request->getPost('cliente_id'),
            'endereco_id' => $this->request->getPost('endereco_id'),
            'status_pedido' => $this->request->getPost('status_pedido'),
        ];

        $pedidoModel->update($pedido_id, $pedidoData);

        // Atualiza itens (para simplificar, deleta e insere de novo)
        $pedidoItensModel->where('pedido_id', $pedido_id)->delete();

        $produtos = $this->request->getPost('produtos');
        $quantidades = $this->request->getPost('quantidades');

        foreach ($produtos as $key => $produto_id) {
            $produtoModel = new Produtos();
            $produto = $produtoModel->find($produto_id);

            $pedidoItensModel->insert([
                'pedido_id' => $pedido_id,
                'produto_id' => $produto_id,
                'quantidade' => $quantidades[$key],
                'preco_venda' => $produto->produtos_preco_venda
            ]);
        }

        return redirect()->to('/pedidos')->with('msg', \msg('Pedido atualizado com sucesso!', 'success'));
    }

    public function delete($id)
    {
        $pedidoModel = new Pedido();
        $pedidoItensModel = new PedidoItem();

        $pedidoItensModel->where('pedido_id', $id)->delete();
        $pedidoModel->delete($id);

        return redirect()->to('/pedidos')->with('msg', \msg('Pedido excluído com sucesso!', 'success'));
    }
}
