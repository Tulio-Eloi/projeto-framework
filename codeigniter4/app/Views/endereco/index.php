<?php
    helper('functions');
    session();
    // if(isset($_SESSION['login'])){
    //     $login = $_SESSION['login'];
    //     print_r($login);
    //     if($login->usuarios_nivel == 1){
    
?>

<div class="container pt-4 pb-5 bg-light">
        <h2 class="border-bottom border-2 border-primary">
            <?= ucfirst($form).' '.$title ?>
        </h2>

        <form action="<?= base_url('endereco/'.$op); ?>" method="post">
            <div class="mb-3">
                <label for="endereco_rua" class="form-label"> Rua </label>
                <input type="text" class="form-control" name="endereco_rua" value="<?= $endereco->endereco_rua; ?>"  id="endereco_rua">
            </div>

            <div class="mb-3">
                <label for="endereco_numero" class="form-label"> Descrição </label>
                <input type="text" class="form-control" name="endereco_numero" value="<?= $endereco->endereco_numero; ?>"  id="endereco_numero">
            </div>

            <div class="mb-3">
                <label for="endereco_complemento" class="form-label"> Preço de Custo </label>
                <input type="text" class="form-control" name="endereco_complemento" value="<?= moedaReal($endereco->endereco_complemento); ?>"  id="endereco_complemento">
            </div>

            <div class="mb-3">
                <label for="endereco_cep" class="form-label"> Preço de Venda </label>
                <input type="text" class="form-control" name="endereco_cep" value="<?= moedaReal($endereco->endereco_cep); ?>"  id="endereco_cep">
            </div>

            <div class="mb-3">
                <label for="endereco_categorias_id" class="form-label"> Categoria </label>
                <select class="form-control" name="endereco_categorias_id"  id="endereco_categorias_id">
                    

                <select class="form-control" name="endereco_status"  id="endereco_status">
                    
                    <?php 
                    for($i=0; $i < count($cidade);$i++){ 
                        $ed = 'select';
                        if($categorias[$i]->categorias_id == $produtos->produtos_categorias_id){
                            $selected = 'selected'; 
                        }
                    ?>
                        <option <?= $selected; ?> value="<?= $categorias[$i]->categorias_id; ?>">
                            <?= $categorias[$i]->categorias_nome; ?>
                        </option>
                    <?php } ?>

                </select>
            </div>

            <input type="hidden" name="endereco_id" value="<?= $endereco->endereco_id; ?>" >

            <div class="mb-3">
                <button class="btn btn-success" type="submit"> <?= ucfirst($form)  ?> <i class="bi bi-floppy"></i></button>
            </div>
        
        </form>

    </div>








<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>