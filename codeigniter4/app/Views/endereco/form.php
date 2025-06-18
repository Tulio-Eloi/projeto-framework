<?php
    helper('functions');
    session();
    $template = '';

    if (isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        if ($login->usuarios_nivel == 1) {
            $template = 'Templates_admin';
        } elseif ($login->usuarios_nivel == 2) {
            $template = 'Templates_funcionarios';
        } elseif ($login->usuarios_nivel == 3) {
            $template = 'Templates_user';
          }else{

            $data['msg'] = msg("Sem permissão de acesso!","danger");
            echo view('login',$data);
        }
    }else{

        $data['msg'] = msg("O usuário não está logado!","danger");
        echo view('login',$data);
    }
        // se não estiver logado
    
?>

<?= $this->extend($template) ?>
<?= $this->section('content') ?>
    <h1><?php echo ucfirst($form). ' '.$titulo ?></h1>

    <form action="<?= base_url('enderecos/'.$op."/");?>"  method="post">
        <div>
            <label for="enderecos_rua"> Rua</label>
            <input type="text" name="enderecos_rua" id="enderecos_rua" 
            value="<?= $endereco['endereco_rua'] ?>" required>
        </div>
        <div>
            <label for="enderecos_numero"> Numero</label>
            <input type="text" name="enderecos_numero" id="enderecos_numero" 
            value="<?= $endereco['endereco_numero']  ?>" required>
        </div>
        <div>
            <label for="enderecos_complemento"> Complemento</label>
            <input type="text" name="enderecos_complemento" id="enderecos_complemento" 
            value="<?= $endereco['endereco_complemento']  ?>" required>
        </div>
        <div>
            <label for="enderecos_cep"> Cep</label>
            <input type="text" name="enderecos_cep" id="enderecos_cep" 
            value="<?= $endereco['endereco_cep']  ?>" required>
        </div>

        <div class="mb-3">
                <label for="endereco_cidade_id" class="form-label"> Cidades </label>
                <select class="form-control" name="endereco_cidade_id"  id="endereco_cidade_id">
                    
                <?php 
                    foreach($cidades as $cidade){ 
                        $selected = '';
                        $ed = 'select';
                        if($cidade->cidades_id == $endereco['endereco_cidade_id']){
                            $selected = 'selected'; 
                        }
                       
                    ?>
                        <option <?=$selected; ?> value="<?= $cidade->cidades_id;; ?>">
                            <?= $cidade->cidades_nome; ?>
                        </option>
                    <?php }?>

                </select>
            </div>
    
          

        <div class="mb-3">
            <button class="btn btn-success" type="submit"> <?= ucfirst($form)  ?> <i class="bi bi-floppy"></i></button>
        </div>

    </form>
<?= $this->endSection() ?>

<?php 
      

?>