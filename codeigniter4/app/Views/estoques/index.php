<?php
    helper('functions');
    session();
?>
<?= $this->extend('Templates_admin') ?>
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
