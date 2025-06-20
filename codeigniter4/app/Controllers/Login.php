<?php

namespace App\Controllers;
use App\Models\Usuarios_model as Usuarios_login;

class Login extends BaseController
{
    private $data;
    private $usuarios;
    public $session;
    public function __construct(){
        helper('functions');
        $this->session = \Config\Services::session();
        $this->usuarios = new Usuarios_login();
        $this->data['title'] = 'Login';
        $this->data['msg'] = ''; 
    }
    public function index(): string
    { 
        return view('login',$this->data);
    }

    public function logar()
    {
        $login = $_REQUEST['login'];
        $senha = md5($_REQUEST['senha']);
        
        $this->data['usuarios'] = $this->usuarios->where
        ('usuarios_email',$login)->where('usuarios_senha',$senha)->find();
        if($this->data['usuarios'] == []){
            $this->data['msg'] = msg('O usuário ou a senha são invalidos!','danger');
            return view('login',$this->data);

        }else{
            if($this->data['usuarios'][0]->usuarios_email == $login  OR
               $this->data['usuarios'][0]->usuarios_senha == $senha ){
                $infoSession = (object)[
                    'usuarios_id' => $this->data['usuarios'][0]->usuarios_id,
                    'usuarios_nome' => $this->data['usuarios'][0]->usuarios_nome,
                    'usuarios_email' => $this->data['usuarios'][0]->usuarios_email,
                    'usuarios_nivel' => $this->data['usuarios'][0]->usuarios_nivel,
                    'logged_in' => TRUE
                ];
                
                $this->session->set('login', $infoSession);
                if($this->data['usuarios'][0]->usuarios_nivel == 3){
                    
                    return view('user/index',$this->data);
                }
                elseif($this->data['usuarios'][0]->usuarios_nivel == 1){
                    return view('admin/index',$this->data);
                }elseif($this->data['usuarios'][0]->usuarios_nivel == 2){
                   
                    return view('funcionario/index',$this->data);
                }else{
                    $this->data['msg'] = msg('Houve um problema com o seu acesso. Procure a Gerência de TI!','danger');
                    return view('login',$this->data);
                }
            }else{
                $this->data['msg'] = msg('O usuário ou a senha são invalidos!','danger');
                return view('login',$this->data);
            }
        }
    }

    public function logout()
    {
        $this->session->remove('login');
        $this->data['msg'] = msg('Usuário desconectado','success');
        return view('login',$this->data);
    }

    public function desconectado(){
        $this->data['msg'] = msg("O usuário não está logado!","danger");
        return view('login',$this->data);
    }


}
