<?php
    helper('functions');
    session();
?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>

<div class="container pt-4 pb-5 bg-light">
    <h2 class="border-bottom border-2 border-primary">
        <?= ucfirst($form).' '.$title ?>
    </h2>

    <form action="<?= base_url('estoques/'.$op); ?>" method="post">
        <div class="mb-3">
            <label for="produtos_nome" class="form-label">Produto</label>
            <input type="text" class="form-control" value="<?= $estoque->produtos_nome ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" value="<?= $estoque->quantidade ?>" id="quantidade">
        </div>

        <input type="hidden" name="id" value="<?= $estoque->id ?>">

        <div class="mb-3">
            <button class="btn btn-success" type="submit">Salvar <i class="bi bi-floppy"></i></button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
