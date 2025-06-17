<?php

namespace App\Controllers;

use App\Models\Cidades;
use App\Models\Endereco;
use App\Models\Entregador as ModelsEntregador;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produtos;


class Entregador extends BaseController
{
    
    private $pedidos;
    private $entregador;
    private $endereco;
    private $cidade;

    public function __construct(){
        $this->pedidos = new Pedido();
        $this->entregador = new ModelsEntregador();
        $this->endereco = new Endereco();
        $this->cidade = new Cidades();
        
    }
    public function index()
    {
        $data['entregador'] = $this->entregador->findAll();
        $data['pedidos'] = $this->pedidos->findAll();
        $data['endereco'] = $this->endereco->findAll();
        $data['cidade'] = $this->cidade->findAll();
        $data['title'] = "Entregas";
      //  foreach( $data['itens'] as $itens):

       
        foreach($data['pedidos'] as $ped):

            foreach($data['endereco'] as $end):
                if($end['endereco_id'] == $ped->endereco_id):
                    foreach($data['cidade'] as $city):
                        if($city->cidades_id == $end['endereco_cidade_id']):
                            foreach($data['entregador'] as $result):
                            //var_dump($ped);
                                if($ped->entregador_id == $result->id_entregador && $ped->status == "Entregue"):
                        
                                    $resultado[] = [
                                        'nome_entrega' => $result->nome_entregador,
                                        'id_ped' =>  $ped->pedido_id,
                                        'status' => $ped->status,
                                        'endereco' => $end['endereco_rua']." ".$end['endereco_numero']." ".$end['endereco_complemento'].' '.$end['endereco_cep'],
                                        'cidade' => $city->cidades_nome
                                    ];
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                endif;
            endforeach;
        endforeach;
        $data['resultados'] = $resultado;
        return view('/entrega/index',$data);
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