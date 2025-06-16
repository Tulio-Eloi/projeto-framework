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

    <form action="" class="d-flex" role="search" method="post">
       
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Produto</th>
                <th scope="col">Vezes pedidos</th>
                <th scope="col">Quantidade vendido</th>
                 <th scope="col">Valor arrecadado</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <!-- Aqui vai o laço de repetição -->
           <?php foreach($resultados as $item): ?>
                <tr>
                    <td><?= esc($item['nome_produtos'])?></td>
                    <td><?= esc($item['vezes']."x")?></td>
                     <td><?= esc($item['vendas'])?></td>
                    <td><?= esc('R$ '.$item['preco'])?></td>
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