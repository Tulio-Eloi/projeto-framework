<?php session() ?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>

<div class="container">

    <h1><?= $titulo ?></h1>
  <?php if(session()->getFlashdata('msg')) { echo session()->getFlashdata('msg'); } ?>
    <p class="text-secondary"> <?= $conteudo ?> </p>

</div>

<?= $this->endSection('content') ?>
