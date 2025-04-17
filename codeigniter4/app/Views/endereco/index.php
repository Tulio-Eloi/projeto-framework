<?php
    helper('functions');
    session();

    
?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>


<div class="container">

<h2 class="border-bottom border-2 border-primary mt-3 mb-4"> <?= $title ?> </h2>

<?php if(isset($msg)){echo $msg;} ?>

<form action="<?= base_url('endereco/search'); ?>" class="d-flex" role="search" method="post">
    <input class="form-control me-2" name="pesquisar" type="search"
        placeholder="Pesquisar" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">
    <i class="bi bi-search"></i>
    </button>
</form>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Rua</th>
            <th scope="col">Complemento</th>
            <th scope="col">numero</th>
            <th scope="col">cep</th>
            <th scope="col">Cidade</th>
            <th scope="col">status</th>
            <th scope="col">
                <a class="btn btn-success"  href="<?= base_url('endereco/new'); ?>">
                    Novo
                    <i class="bi bi-plus-circle"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        
        <!-- Aqui vai o laço de repetição -->
        <?php foreach($endereco as $enderecos){ ?>
            <?php         $login = session()->get('login');
?>
            <?php if($enderecos['endereco_usuario_id'] == $login->usuarios_id){ ?>
                <?php if($enderecos['endereco_status'] == 1){ ?>

            <tr>
                <th scope="row"><?=$enderecos['endereco_rua']; ?></th>
                <td><?= $enderecos['endereco_complemento']; ?></td>
                <td><?= $enderecos['endereco_numero']; ?></td>
                <td><?= $enderecos['endereco_cep']; ?></td>
                <td><?= $enderecos['cidades_nome'];?></td>
                <td><?= "ativo" ?></td>

                <td>
                    <a class="btn btn-primary"  href="<?= base_url('enderecos/editar/'.$enderecos['endereco_id']); ?>">
                        Editar
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="btn btn-danger"  href="<?= base_url('enderecos/deletar/'.$enderecos['endereco_id']); ?>">
                        Excluir
                        <i class="bi bi-x-circle"></i>
                    </a>
                </td>
            </tr>
            <?php }else{?>
                 <tr>
                <th scope="row"><?=$enderecos['endereco_rua']; ?></th>
                <td><?= $enderecos['endereco_complemento']; ?></td>
                <td><?= $enderecos['endereco_numero']; ?></td>
                <td><?= $enderecos['endereco_cep']; ?></td>
                <td><?= $enderecos['endereco_cidade_id']; ?></td>
                <td><?= "inativo" ?></td>

                <td>
                    <a class="btn btn-primary"  href="<?= base_url('enderecos/editar/'.$enderecos['endereco_id']); ?>">
                        Editar
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="btn btn-danger"  href="<?= base_url('enderecos/deletar/'.$enderecos['endereco_id']); ?>">
                        Excluir
                        <i class="bi bi-x-circle"></i>
                    </a>
                </td>
            </tr>?>
                    <?php }?>


            <?php }else{?>
                <?php echo "Nenhum endereço cadastrado"?>

                <?php }?>

        <?php } ?>

    </tbody>
</table>

</div>
           
        </p>
        </div>




<?= $this->endSection() ?>

