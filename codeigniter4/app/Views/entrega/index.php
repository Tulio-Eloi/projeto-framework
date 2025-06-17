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
                <th scope="col">Nome do entregador</th>
                <th scope="col">Numero do pedido</th>
                <th scope="col">Endereço entregue</th>
                <th scope="col">Cidade</th>
                <th scope="col">Status</th>
              
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <!-- Aqui vai o laço de repetição -->
           <?php foreach($resultados as $ped): ?>
                <tr>
                    <td><?= esc($ped['nome_entrega'])?></td>
                     <td><?= esc($ped['id_ped'])?></td>
                     <td><?= esc($ped['endereco'])?></td>
                      <td><?= esc($ped['cidade'])?></td>
                    <td><?= esc($ped['status'])?></td>
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