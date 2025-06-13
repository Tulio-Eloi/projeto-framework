<?php

namespace App\Controllers;

use App\Models\Produtos;
use App\Models\ProdutosVendas;
use App\Models\Usuarios_model;
use App\Models\Vendas as ModelsVendas;

class Vendas extends BaseController
{
    private $vendas;
    private $produtos;
    private $produtosVenda;
    private $usuarios;

    public function __construct(){
        $this->vendas = new ModelsVendas();
        $this->produtos = new Produtos();
        $this->produtosVenda = new ProdutosVendas();
        $this->usuarios = new Usuarios_model();
       // $this->nivel = new Nivel();
        $data['title'] = 'Vendas';
        helper('functions');
    }
    public function index()
    {
        $data['title'] = 'Vendas';
        $data['vendas_prod'] = $this->produtosVenda->findAll();
         $data['prod'] = $this->produtos->findAll();
         $data['vendas'] = $this->vendas->findAll();
         $data['usuarios'] = $this->usuarios->findAll();
         $produtoEncontrado = null;
         $vendaEncontrado = null;
         $usuarioEncontrado = null;
        foreach($data['vendas_prod'] as $prod){
           var_dump($prod);
            foreach( $data['prod'] as $prods){

                if($prods->produtos_id == $prod->id_produto){
                     $produtoEncontrado = $prods;
                    break;
                
                }
                }
                foreach($data['vendas'] as $vend){
                       
                        if($vend->vendas_id == $prod->Id_vendas ){
                            foreach($data['usuarios'] as $user){
                                if($user->usuarios_id == $vend->vendas_usuario_id){
                                    $vendaEncontrado = $vend;
                                    $usuarioEncontrado = $user;
                                    break;
                                }
                            }
                              
                        }
                    }
            if($vendaEncontrado && $produtoEncontrado){
                 $data['resultado'] = [
                'produto' => $produtoEncontrado,
                'venda' => $vendaEncontrado,
                'user' => $usuarioEncontrado
            ];
            
            }
           
        }
        var_dump($data);
        return view('vendas/index',$data);
    }

    // public function new()
    // {
    //     $data['title'] = 'Usuarios';
    //     $data['op'] = 'create';
    //     $data['form'] = 'cadastrar';
    //     $data['usuarios'] = (object) [
    //         'usuarios_nome'=> '',
    //        'usuarios_email'=> '',
    //         'usuarios_senha'=> '',
    //         'usuarios_nivel' => '',
    //         'usuarios_id'=> ''
    //     ];

    //     $data['cliente'] = (object) [
    //         'id_clientes' => '',
    //         'nome_cliente' => '',
    //         'sobrenome_cliente' => '',
    //         'cpf_cliente' => '',
    //         'data_nasc_cliente' => '', 
    //         'fone_cliente' => '', 
    //         'usuario_cliente' => ''

    //     ];   
    //     $data['niveis'] = $this->nivel->findAll();
      
    //    return view('usuarios/form',$data);
    // }
    // public function create()
    // {
    
    //     $data['usuarios'] = (object) [
    //         'usuarios_id' => '',
    //         'usuarios_nome' => $_REQUEST['usuarios_nome'],
    //         'usuarios_email' => $_REQUEST['usuarios_email'],
    //         'usuarios_senha' => md5($_REQUEST['usuarios_senha']),
    //         'usuarios_data_cadastro' => date('Y-m-d'), 
    //         'usuarios_nivel'=> $_REQUEST['nivel'], 
    //     ];         
    //     $id = $this->usuarios->insert($data['usuarios'], true);
        
        

    //    $data['cliente'] = (object) [
    //         'id_clientes' => '',
    //         'nome_cliente' => $_REQUEST['nome_cliente'],
    //         'sobrenome_cliente' => $_REQUEST['sobrenome_cliente'],
    //         'cpf_cliente' => $_REQUEST['cpf_cliente'],
    //         'data_nasc_cliente' => date('Y-m-d',strtotime($_REQUEST['data_nasc_cliente'])), 
    //         'fone_cliente' => $_REQUEST['fone_cliente'], 
    //         'usuario_cliente' => $id

    //     ];   

    //     $this->cliente->insert($data['cliente']);
        
    //     $data['msg'] = msg('Cadastrado com Sucesso!','success');
    //     $data['usuarios'] = $this->usuarios->findAll();
    //     $data['cliente'] = $this->cliente->findAll();
    //     $data['title'] = 'Usuarios';
    //    return view('usuarios/index',$data);
     
        
    // }

    // public function delete($id)
    // {
    //     $this->cliente->where('usuario_cliente', (int) $id)->delete();
    //     $this->usuarios->where('usuarios_id', (int) $id)->delete();
    //     $data['msg'] = msg('Deletado com Sucesso!','success');
    //     $data['usuarios'] = $this->usuarios->findAll();
    //     $data['title'] = 'Usuarios';
    //     return view('usuarios/index',$data);
    // }

    // public function edit($id)
    // {
    //     $data['usuarios'] = $this->usuarios->find(['usuarios_id' => (int) $id])[0];
    //     $usuarios =  $data['usuarios'];
        
    //     $data['cliente'] = $this->cliente
    //     ->where('usuario_cliente', (int) $usuarios->usuarios_id)
    //     ->first();


    //     $data['niveis'] = $this->nivel->findAll();
  
    //     $data['title'] = 'Usuarios';
    //     $data['form'] = 'Alterar';
    //     $data['op'] = 'update';
    //     return view('usuarios/form',$data);
    // }

    // public function update()
    // {
    //     $dataForm = [
    //         'usuarios_id' => '',
    //         'usuarios_nome' => $_REQUEST['usuarios_nome'],
    //         'usuarios_email' => $_REQUEST['usuarios_email'],
    //         'usuarios_nivel' => $_REQUEST['nivel'], 
    //     ];
    //     $clientesFrom = [
    //         'id_clientes' => '',
    //         'nome_cliente' => $_REQUEST['nome_cliente'],
    //         'sobrenome_cliente' => $_REQUEST['sobrenome_cliente'],
    //         'cpf_cliente' => $_REQUEST['cpf_cliente'],
    //         'data_nasc_cliente' => date('Y-m-d',strtotime($_REQUEST['data_nasc_cliente'])), 
    //         'fone_cliente' => $_REQUEST['fone_cliente'], 
    //         'usuario_cliente' => $_REQUEST['usuarios_id']

    //     ];  
    //     $this->usuarios->update($_REQUEST['usuarios_id'], $dataForm);
    //     $this->cliente->update($_REQUEST['id_clientes'],$clientesFrom);
    //     $data['msg'] = msg('Alterado com Sucesso!','success');
    //     $data['usuarios'] = $this->usuarios->findAll();
    //     $data['title'] = 'Usuarios';
    //     return view('usuarios/index',$data);
    // }

    // public function search()
    // {
    //     //$data['usuarios'] = $this->usuarios->like('usuarios_nome', $_REQUEST['pesquisar'])->find();
    //    // $data['usuarios'] = $this->usuarios->like('usuarios_nome', $_REQUEST['pesquisar'])->orlike('usuarios_cpf', $_REQUEST['pesquisar'])->find();
    //    $data['usuarios'] = $this->usuarios->like('usuarios_nome', $_REQUEST['pesquisar'])->orlike('usuarios_id', $_REQUEST['pesquisar'])->find();
        
    //    $total = count($data['usuarios']);
    //     $data['msg'] = msg("Dados Encontrados: {$total}",'success');
    //     $data['title'] = 'Usuarios';
    //     return view('usuarios/index',$data);

    // }
}

?>