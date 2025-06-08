<?php

namespace App\Controllers;
use App\Models\Usuarios_model as Usuarios_model;
use App\Models\Cliente as Cliente_model;
use App\Models\Nivel as Nivel;


class Usuarios extends BaseController
{
    private $usuarios;
    private $cliente;
    private $nivel;

    public function __construct(){
        $this->usuarios = new Usuarios_model();
        $this->cliente = new Cliente_model();
        $this->nivel = new Nivel();
        $data['title'] = 'Usuarios';
        helper('functions');
    }
    public function index(): string
    {
        $data['title'] = 'Usuarios';
        $data['usuarios'] = $this->usuarios->findAll();
        return view('usuarios/index',$data);
    }

    public function new()
    {
        $data['title'] = 'Usuarios';
        $data['op'] = 'create';
        $data['form'] = 'cadastrar';
        $data['usuarios'] = (object) [
            'usuarios_nome'=> '',
           'usuarios_email'=> '',
            'usuarios_senha'=> '',
            'usuarios_id'=> ''
        ];

        $data['cliente'] = (object) [
            'id_clientes' => '',
            'nome_cliente' => '',
            'sobrenome_cliente' => '',
            'cpf_cliente' => '',
            'data_nasc_cliente' => '', 
            'fone_cliente' => '', 
            'nivel_id_cliente' => '', 
            'usuario_cliente' => ''

        ];   
        $data['nivel'] = $this->nivel->findAll();
        echo "<br> <br> <br>";
        var_dump( $data['nivel']);
       return view('usuarios/form',$data);
    }
    public function create()
    {
    
        $data['usuarios'] = (object) [
            'usuarios_id' => '',
            'usuarios_nome' => $_REQUEST['usuarios_nome'],
            'usuarios_email' => $_REQUEST['usuarios_email'],
            'usuarios_senha' => md5($_REQUEST['usuarios_senha']),
            'usuarios_data_cadastro' => date('Y-m-d'), 
        ];         
        $id = $this->usuarios->insert($data['usuarios'], true);
        echo "<br> <br> <br>";
        

       $data['cliente'] = (object) [
            'id_clientes' => '',
            'nome_cliente' => $_REQUEST['nome_cliente'],
            'sobrenome_cliente' => $_REQUEST['sobrenome_cliente'],
            'cpf_cliente' => $_REQUEST['cpf_cliente'],
            'data_nasc_cliente' => date('Y-m-d',strtotime($_REQUEST['data_nasc_cliente'])), 
            'fone_cliente' => $_REQUEST['fone_cliente'], 
            'nivel_id_cliente' => $_REQUEST['nivel'], 
            'usuario_cliente' => $id

        ];   
       $datas = date('Y-m-d',strtotime($_REQUEST['data_nasc_cliente']));
       echo($datas);
        $this->cliente->insert($data['cliente']);
        
        $data['msg'] = msg('Cadastrado com Sucesso!','success');
        $data['usuarios'] = $this->usuarios->findAll();
        $data['cliente'] = $this->cliente->findAll();
        $data['title'] = 'Usuarios';
       return view('usuarios/index',$data);
     
        
    }

    public function delete($id)
    {
        $this->usuarios->where('usuarios_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['usuarios'] = $this->usuarios->findAll();
        $data['title'] = 'Usuarios';
        return view('usuarios/index',$data);
    }

    public function edit($id)
    {
        $data['usuarios'] = $this->usuarios->find(['usuarios_id' => (int) $id])[0];
        $data['title'] = 'Usuarios';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('usuarios/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'usuarios_id' => $_REQUEST['usuarios_id'],
            'usuarios_nome' => $_REQUEST['usuarios_nome'],
            'usuarios_sobrenome' => $_REQUEST['usuarios_sobrenome'],
            'usuarios_email' => $_REQUEST['usuarios_email'],
            'usuarios_cpf' => $_REQUEST['usuarios_cpf'],
            'usuarios_data_nasc' => $_REQUEST['usuarios_data_nasc'],
            'usuarios_fone' => $_REQUEST['usuarios_fone'],
            'usuarios_nivel' => 0
        ];

        $this->usuarios->update($_REQUEST['usuarios_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['usuarios'] = $this->usuarios->findAll();
        $data['title'] = 'Usuarios';
        return view('usuarios/index',$data);
    }

    public function search()
    {
        //$data['usuarios'] = $this->usuarios->like('usuarios_nome', $_REQUEST['pesquisar'])->find();
        $data['usuarios'] = $this->usuarios->like('usuarios_nome', $_REQUEST['pesquisar'])->orlike('usuarios_cpf', $_REQUEST['pesquisar'])->find();
        $total = count($data['usuarios']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Usuarios';
        return view('usuarios/index',$data);

    }

    public function edit_senha(): string
    {
        $data['usuarios'] = (object) [
            'usuarios_nova_senha'=> '',
            'usuarios_confirmar_senha'=> ''
        ];

        $data['title'] = 'Usuarios';
        return view('usuarios/edit_senha',$data);
    }

    public function salvar_senha():string {

        // Checks whether the submitted data passed the validation rules.
        if(!$this->validate([
            'usuarios_senha_atual' => 'required',
            'usuarios_nova_senha' => 'required|max_length[14]|min_length[6]',
            'usuarios_confirmar_senha' => 'required|max_length[14]|min_length[6]'
        ])) {
            
            // The validation fails, so returns the form.
            $data['usuarios'] = (object) [
                'usuarios_senha_atual' => $_REQUEST['usuarios_senha_atual'],
                'usuarios_nova_senha' => $_REQUEST['usuarios_nova_senha'],
                'usuarios_confirmar_senha' => $_REQUEST['usuarios_confirmar_senha']
            ];
            $data['title'] = 'Usuarios';
            $data['msg'] = msg("Divergência de dados ou a senha deve ter no mínimo 6 digitos!","danger");
            return view('usuarios/edit_senha',$data);
        }

        $data['usuarios'] = (object) [
            'usuarios_senha_atual' => $_REQUEST['usuarios_senha_atual'],
            'usuarios_nova_senha' => $_REQUEST['usuarios_nova_senha'],
            'usuarios_confirmar_senha' => $_REQUEST['usuarios_confirmar_senha']
        ];

        $data['check_senha'] = $this->usuarios->find(['usuarios_id' => (int) $_REQUEST['usuarios_id']])[0];

        if($data['check_senha']->usuarios_senha == md5($_REQUEST['usuarios_senha_atual'])){
            if($_REQUEST['usuarios_nova_senha'] == $_REQUEST['usuarios_confirmar_senha']){

                $dataForm = [
                    'usuarios_id' => $_REQUEST['usuarios_id'],
                    'usuarios_senha' => md5($_REQUEST['usuarios_nova_senha'])
                ];
        
                $this->usuarios->update($_REQUEST['usuarios_id'], $dataForm);
                $data['msg'] = msg('Senha alterada!','success');
                $data['usuarios'] = $this->usuarios->findAll();
                $data['title'] = 'Usuarios';
                return view('usuarios/index',$data);


            }else{
                $data['title'] = 'Usuarios';
                $data['msg'] = msg("As senhas não são iguais!","danger");
                return view('usuarios/edit_senha',$data);
            }

        }else{
            $data['title'] = 'Usuarios';
            $data['msg'] = msg("A senha atual é invalida","danger");
            return view('usuarios/edit_senha',$data);
        }
    }
    
    public function edit_nivel(): string
    {
        $data['nivel'] = [
            ['id' => 0, 'nivel' => "Usuário"],
            ['id' => 1, 'nivel' => "Administrador"],
            ['id' => 2, 'nivel' => "Supervisor"]
        ];

        $data['usuarios'] = $this->usuarios->findAll();
        $data['title'] = 'Usuarios';


        $data['usuarios'] = $this->usuarios->findAll();
        $data['title'] = 'Usuarios';
        return view('usuarios/edit_nivel',$data);
    }

    public function salvar_nivel(): string
    {

        $dataForm = [
            'usuarios_id' => $_REQUEST['usuarios_id'],
            'usuarios_nivel' => $_REQUEST['usuarios_nivel']
        ];

        $this->usuarios->update($_REQUEST['usuarios_id'], $dataForm);
        $data['msg'] = msg('Nivel alterada!','success');
        $data['usuarios'] = $this->usuarios->findAll();
        $data['title'] = 'Usuarios';
        return view('usuarios/index',$data);
    }



}
