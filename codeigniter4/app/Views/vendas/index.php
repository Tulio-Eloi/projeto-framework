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

<div class="container">

    <h2 class="border-bottom border-2 border-primary mt-5 pt-3 mb-4"> <?= $title ?> </h2>

    <?php if(isset($msg)){echo $msg;} ?>

    <form action="<?= base_url('usuarios/search'); ?>" class="d-flex" role="search" method="post">
        <input class="form-control me-2" name="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nº Pedido</th>
                <th scope="col">Nome</th>
                 <th scope="col">Item</th>
                <th scope="col">Valor total</th>
                <th scope="col">Data do pedido</th>
                <th scope="col">
                    <a class="btn btn-success" href="<?= base_url('#'); ?>"> 
                        Novo
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <!-- Aqui vai o laço de repetição -->
           <?php foreach($resultado as $item): ?>
                <tr>
                    <th scope="row"><?= $item['venda_id']; ?></th>
                    <td><?= $item['user']?></td>
                     <td><?= $item['produto']?></td>
                    <td><?= $item['venda_valor']?></td>
                    <td><?= $item['venda_compra']?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= base_url('usuarios/edit/'.$item["venda_id"]); ?>">
                            Editar
                        </a>
                        <a class="btn btn-danger" href="<?= base_url('usuarios/delete/'.$item["venda_id"]); ?>">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

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