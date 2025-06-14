<?php
    helper('functions');
    session();
?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2 class="border-bottom border-2 border-primary mt-3 mb-4"> Estoques </h2>

    <?php if(isset($msg)){echo $msg;} ?>

    <form action="<?= base_url('estoques/search'); ?>" class="d-flex" role="search" method="post">
        <input class="form-control me-2" name="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">
                    <a class="btn btn-success" href="<?= base_url('estoques/new'); ?>">
                        Novo
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php for($i=0; $i < count($estoques); $i++){ ?>
                <tr>
                    <th scope="row"><?= $estoques[$i]->id; ?></th>
                    <td><?= $estoques[$i]->produto_nome; ?></td>
                    <td><?= $estoques[$i]->quantidade; ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= base_url('estoques/edit/'.$estoques[$i]->id); ?>">
                            Editar
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a class="btn btn-danger" href="<?= base_url('estoques/delete/'.$estoques[$i]->id); ?>">
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
