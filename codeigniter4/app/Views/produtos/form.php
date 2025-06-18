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
<?= $this->extend($template ) ?>
<?= $this->section('content') ?>



    <div class="container pt-4 pb-5 bg-light">
        <h2 class="border-bottom border-2 border-primary">
            <?= ucfirst($form).' '.$title ?>
        </h2>

        <form action="<?= base_url('produtos/'.$op); ?>" method="post">
            <div class="mb-3">
                <label for="produtos_nome" class="form-label"> Produto </label>
                <input type="text" class="form-control" name="produtos_nome" value="<?= $produtos->produtos_nome; ?>"  id="produtos_nome">
            </div>

            <div class="mb-3">
                <label for="produtos_descricao" class="form-label"> Descrição </label>
                <input type="text" class="form-control" name="produtos_descricao" value="<?= $produtos->produtos_descricao; ?>"  id="produtos_descricao">
            </div>

            <div class="mb-3">
                <label for="produtos_preco_custo" class="form-label"> Preço de Custo </label>
                <input type="text" class="form-control" name="produtos_preco_custo" value="<?= moedaReal($produtos->produtos_preco_custo); ?>"  id="produtos_preco_custo">
            </div>

            <div class="mb-3">
                <label for="produtos_preco_venda" class="form-label"> Preço de Venda </label>
                <input type="text" class="form-control" name="produtos_preco_venda" value="<?= moedaReal($produtos->produtos_preco_venda); ?>"  id="produtos_preco_venda">
            </div>

            

            <input type="hidden" name="produtos_id" value="<?= $produtos->produtos_id; ?>" >

            <div class="mb-3">
                <button class="btn btn-success" type="submit"> <?= ucfirst($form)  ?> <i class="bi bi-floppy"></i></button>
            </div>
        
        </form>

    </div>

<?= $this->endSection() ?>


