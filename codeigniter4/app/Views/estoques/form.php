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
            <label for="produto_id" class="form-label"> Produto </label>
            <select class="form-select" name="produto_id" id="produto_id" required>
                <option value="">Selecione...</option>
                <?php foreach($produtos as $p): ?>
                    <option value="<?= $p->id ?>"
                        <?= (isset($estoques->produto_id) && $estoques->produto_id == $p->id) ? 'selected' : '' ?>>
                        <?= $p->nome ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label"> Quantidade </label>
            <input type="number" class="form-control" name="quantidade" id="quantidade"
                   value="<?= isset($estoques->quantidade) ? $estoques->quantidade : '' ?>" required>
        </div>

        <input type="hidden" name="id" value="<?= isset($estoques->id) ? $estoques->id : '' ?>">

        <div class="mb-3">
            <button class="btn btn-success" type="submit"> <?= ucfirst($form) ?> <i class="bi bi-floppy"></i></button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
