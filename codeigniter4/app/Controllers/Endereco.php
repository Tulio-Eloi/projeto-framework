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
        $data['titulo'] = 'Endereços';
        $data['op'] = 'create';
        $data['form'] = 'enderecos';
        //$data['cidade'] = $this->cidades->findAll();
     
         $data['title'] = 'Categorias';
        $data['endereco'] = $this->endereco->findAll();
        $data['cidade'] = $this->cidade->findAll();

        
        return view('endereco/index', $data);
    }
    public function new()
    {
        $data['titulo'] = 'Criar';
        $data['op'] = 'create';
        $data['form'] = 'enderecos';
        $data['cidades'] = $this->cidade->findAll();
        //var_dump($data);
        $data['endereco'] = ['endereco_rua' => "",
              'endereco_complemento' => "",
              'endereco_numero' => "",
               'endereco_cep'=> "",
               'endereco_usuario_' => "",
               'endereco_status' => "",
               'endereco_cidade_id' => ""];
        //$data['cidade'] = $this->cidades->findAll();
     

        
        return view('endereco/form', $data);
    }
    public function create()
    {

            $login = session()->get('login');

            $data = ['endereco_rua' => $_POST['enderecos_rua'],
               'endereco_complemento' => $_POST['enderecos_complemento'],
               'endereco_numero' => $_POST['enderecos_numero'],
               'endereco_cep' => $_POST['enderecos_cep'],
               'endereco_usuario_id' => $login->usuarios_id,
               'endereco_status' => 1,
               'endereco_cidade_id' => $_POST['endereco_cidade_id']];
       
   

           
        //echo session()->get('login');

         $this->endereco->insert($data);
        
        $data['msg'] = msg('Cadastrado com Sucesso!','success');
        $data['endereco'] = $this->endereco->findAll();

        //var_dump($data['endereco']);
        $data['title'] = 'Endereco';
       return view('endereco/index',$data);

    }

    public function deletar($id)
    {

        $this->endereco->where('endereco_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['endereco'] = $this->endereco->findAll();
        $data['title'] = 'Endereço';
        
        return view('endereco/index',$data);
    }

    public function edit($id)
    {
       
        $data['endereco'] = $this->endereco->find(['endereco_id' => (int) $id])[0];
        $data['titulo'] = 'Endereco';
        //var_dump( $data['endereco']);
        $data['form'] = 'enderecos';
        $data['op'] = 'update';
        $data['cidades']= $this->cidade->findAll() ;
        $session = session();

        $session->set([
            'id' => $id,
            
        ]);
        //$data['cidades']= $this->cidade->findAll($data['endereco']['endereco_cidade_id']) ;

           //var_dump( $data['cidades']);

        
        return view('endereco/form',$data);
    }

    public function update()
    {

        $login = session()->get('login');
        $dataForm = ['endereco_rua' => $_POST['enderecos_rua'],
        'endereco_complemento' => $_POST['enderecos_complemento'],
        'endereco_numero' => $_POST['enderecos_numero'],
        'endereco_cep' => $_POST['enderecos_cep'],
        'endereco_usuario_id' => $login->usuarios_id,
        'endereco_status' => 1,
        'endereco_cidade_id' => $_POST['endereco_cidade_id']];
        $ids = session()->get('id');
        $id= $this->endereco->find($ids);
        //var_dump($id);
        $this->endereco->update($id, $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['endereco'] = $this->endereco->findAll();
        $data['title'] = 'Endereco';
        return view('endereco/index',$data);
    }

    public function search()
    {

        $data['endereco'] = $this->endereco
        ->join('cidades', 'cidades.cidades_id = endereco.endereco_cidade_id')
        ->like('endereco_rua', $_REQUEST['pesquisar'])
        ->orLike('endereco_cep', $_REQUEST['pesquisar'])
        ->orLike('endereco_complemento', $_REQUEST['pesquisar'])
        ->orLike('endereco_numero', $_REQUEST['pesquisar'])
        ->orLike('cidades.cidades_nome', $_REQUEST['pesquisar'])
        ->find();


        $total = count($data['endereco']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Endereco';
        return view('endereco/index',$data);

    }

}
