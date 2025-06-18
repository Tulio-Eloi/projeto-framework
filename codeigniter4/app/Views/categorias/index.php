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


    <div class="container">

        <h2 class="border-bottom border-2 border-primary mt-3 mb-4"> <?= $title ?> </h2>

        <?php if(isset($msg)){echo $msg;} ?>

        <form action="<?= base_url('categorias/search'); ?>" class="d-flex" role="search" method="post">
            <input class="form-control me-2" name="pesquisar" type="search"
                placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">
            <i class="bi bi-search"></i>
            </button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">
                        <a class="btn btn-success"  href="<?= base_url('categorias/new'); ?>">
                            Novo
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                
                <!-- Aqui vai o laço de repetição -->
                <?php for($i=0; $i < count($categorias); $i++){ ?>
                    <tr>
                        <th scope="row"><?= $categorias[$i]->categorias_id; ?></th>
                        <td><?= $categorias[$i]->categorias_nome; ?></td>
                        <td>
                            <a class="btn btn-primary"  href="<?= base_url('categorias/edit/'.$categorias[$i]->categorias_id); ?>">
                                Editar
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a class="btn btn-danger"  href="<?= base_url('categorias/delete/'.$categorias[$i]->categorias_id); ?>">
                                Excluir
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
<?= $this->endSection() ?>


