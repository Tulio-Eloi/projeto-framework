<?php
    helper('functions');
    session();
    if(isset($_SESSION['login'])){
        $login = $_SESSION['login'];
        if($login->usuarios_nivel == 2){
    
?>
<?= $this->extend('Templates_funcionarios') ?>
<?= $this->section('content') ?>


    <div class="container pt-4 pb-5 bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Funcionario</a></li>

                <span class="breadcrumb-text"> Seja bem vindo <?= $login->usuarios_nome ?></span>
            </ol>     
        </nav>
        <h2 class="border-bottom border-2 border-primary">
            Funcionario
        </h2>
        <p></p>

        <p>
            
        </p>
        </div>

<?= $this->endSection() ?>

<?php 
        }else{

            $data['msg'] = msg("Sem permissão de acesso!","danger");
            echo view('login',$data);
        }
    }else{

        $data['msg'] = msg("O usuário não está logado!","danger");
        echo view('login',$data);
    }

?>