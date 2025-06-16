<?php
    helper('functions');
    session();
?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2 class="border-bottom border-2 border-primary mt-3 mb-4"><?= $title ?></h2>

    <?php if(session()->getFlashdata('msg')) { echo session()->getFlashdata('msg'); } ?>

    <a href="<?= base_url('pedidos/create') ?>" class="btn btn-success mb-3">
        Novo Pedido <i class="bi bi-plus-square"></i>
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pedidos as $pedido): ?>
                <tr>
                    <td><?= $pedido->pedido_id ?></td>
                    <td><?= esc($pedido->nome_cliente) ?></td>
                    <td><?= esc($pedido->fone_cliente) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($pedido->data_pedido)) ?></td>
                    <td><?= esc($pedido->status) ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= base_url('pedidos/edit/'.$pedido->pedido_id) ?>">
                            Editar <i class="bi bi-pencil-square"></i>
                        </a>
                        <a class="btn btn-danger" href="<?= base_url('pedidos/delete/'.$pedido->pedido_id) ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir este pedido?');">
                            Excluir <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
