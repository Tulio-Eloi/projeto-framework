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
        } else{

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


<div class="container">
    <h2 class="border-bottom border-2 border-primary mt-3 mb-4"><?= $title ?></h2>

    <?php if(session()->getFlashdata('msg')) { echo session()->getFlashdata('msg'); } ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($estoques as $estoque): ?>
                <tr>
                    <td><?= $estoque->id ?></td>
                    <td><?= $estoque->produtos_nome ?></td>
                    <td><?= $estoque->quantidade ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= base_url('estoques/edit/'.$estoque->id) ?>">
                            Editar <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

