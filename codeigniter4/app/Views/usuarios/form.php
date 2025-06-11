<?php
    helper('functions');
    session();
    // if(isset($_SESSION['login'])){
    //     $login = $_SESSION['login'];
    //     print_r($login);
    //     if($login->usuarios_nivel == 1){
    
?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>


    <div class="container pt-4 pb-5 bg-light">
        <h2 class="border-bottom border-2 border-primary">
            <?= ucfirst($form).' '.$title ?>
        </h2>

        <form action="<?= base_url('usuarios/'.$op); ?>" method="post">
            <div class="mb-3">
                <label for="usuarios_nome" class="form-label"> Nome de Login </label>
                <input type="text" class="form-control" name="usuarios_nome" value="<?= $usuarios->usuarios_nome; ?>"  id="usuarios_nome">
            </div>

                  
            <div class="mb-3">
                <label for="usuarios_email" class="form-label"> E-mail </label>
                <input type="email" class="form-control" name="usuarios_email" value="<?= $usuarios->usuarios_email; ?>"  id="usuarios_email">
            </div>

            <div class="mb-3">
                <label for="usuarios_senha" class="form-label"> Senha </label>
                <input type="password" class="form-control" name="usuarios_senha" value="<?= $usuarios->usuarios_senha; ?>"  id="usuarios_senha">
            </div>

            <div class="mb-3">
                <label for="nome_cliente" class="form-label"> Nome </label>
                <input type="text" class="form-control" name="nome_cliente" value="<?= $cliente->nome_cliente; ?>"  id="nome_cliente">
            </div>

            <div class="mb-3">
                <label for="sobrenome_cliente" class="form-label"> Sobrenome </label>
                <input type="text" class="form-control" name="sobrenome_cliente" value="<?= $cliente->sobrenome_cliente; ?>"  id="sobrenome_cliente">
            </div>

            <div class="mb-3">
                <label for="cpf_cliente" class="form-label"> CPF </label>
                <input type="text" class="form-control" name="cpf_cliente" value="<?= $cliente->cpf_cliente; ?>"  id="cpf_cliente">
            </div>

            <div class="mb-3">
                <label for="data_nasc_cliente" class="form-label"> Data de nascimento </label>
                <input type="date" class="form-control" name="data_nasc_cliente" value="<?= $cliente->data_nasc_cliente; ?>"  id="data_nasc_cliente">
            </div>

            <div class="mb-3">
                <label for="fone_cliente" class="form-label"> Telefone </label>
                <input type="text" class="form-control" name="fone_cliente" value="<?= $cliente->fone_cliente; ?>"  id="fone_cliente">
            </div>
            <div class="mb-3">
                <label for="nivel">Nível</label>
                <select name="nivel" class="form-control" required>
                    <?php foreach ($nivel as $n): ?>
                        <option value="<?= esc($n->id_nivel) ?>"
                            <?= isset($cliente) && $cliente->nivel_id_cliente == $n->id_nivel ? 'selected' : '' ?>>
                            <?= esc($n->nivel) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
           

            <input type="hidden" name="usuarios_id" value="<?= $usuarios->usuarios_id; ?>" >
            <input type="hidden" name="id_clientes" value="<?= $cliente->id_clientes; ?>" >
            <div class="mb-3">
                <button class="btn btn-success" type="submit"> <?= ucfirst($form)  ?> <i class="bi bi-floppy"></i></button>
            </div>
        
        </form>

    </div>

<?= $this->endSection() ?>

<?php 
    //     }else{

    //         $data['msg'] = msg("Sem permissão de acesso!","danger");
    //         echo view('login',$data);
    //     }
    // }else{

    //     $data['msg'] = msg("O usuário não está logado!","danger");
    //     echo view('login',$data);
    // }

?>