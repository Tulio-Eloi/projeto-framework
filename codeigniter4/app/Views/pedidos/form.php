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

    <form action="<?= base_url('pedidos/'.$op); ?>" method="post">
        <?php if(isset($pedido->pedido_id)): ?>
            <input type="hidden" name="pedido_id" value="<?= $pedido->pedido_id ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select class="form-select" name="cliente_id" id="cliente_id" required>
                <option value="">Selecione o cliente</option>
                <?php foreach($clientes as $cliente): ?>
                    <option value="<?= $cliente->id_clientes ?>"
                        <?= (isset($pedido->cliente_id) && $pedido->cliente_id == $cliente->id_clientes) ? 'selected' : '' ?>>
                        <?= $cliente->nome_cliente ?> - <?= $cliente->fone_cliente ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="endereco_id" class="form-label">Endereço</label>
            <select class="form-select" name="endereco_id" id="endereco_id" required>
                <option value="">Selecione o endereço</option>
                <?php foreach($enderecos as $endereco): ?>
                    <option value="<?= $endereco['endereco_id'] ?>"
                        <?= (isset($pedido->endereco_id) && $pedido->endereco_id == $endereco['endereco_id']) ? 'selected' : '' ?>>
                        <?= $endereco['endereco_rua'] ?>, <?= $endereco['endereco_numero'] ?> - <?= $endereco['endereco_cidade_id'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="status_pedido" class="form-label">Status</label>
            <input type="text" class="form-control" name="status_pedido" id="status_pedido" 
                   value="<?= isset($pedido->status_pedido) ? $pedido->status_pedido : '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Produtos</label>
            <div id="produtos-lista">
                <?php if (isset($pedido_itens) && count($pedido_itens) > 0): ?>
                    <?php foreach ($pedido_itens as $item): ?>
                        <div class="row mb-2 produto-item">
                            <div class="col">
                                <select class="form-select" name="produtos[]">
                                    <option value="">Selecione o produto</option>
                                    <?php foreach($produtos as $produto): ?>
                                        <option value="<?= $produto->produtos_id ?>"
                                            <?= ($item->produto_id == $produto->produtos_id) ? 'selected' : '' ?>>
                                            <?= $produto->produtos_nome?> - R$ <?= number_format($produto->produtos_preco_venda, 2, ',', '.') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" name="quantidades[]" 
                                       value="<?= $item->quantidade ?>" min="1" required>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger btn-remover-produto">Remover</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="row mb-2 produto-item">
                        <div class="col">
                            <select class="form-select" name="produtos[]">
                                <option value="">Selecione o produto</option>
                                <?php foreach($produtos as $produto): ?>
                                    <option value="<?= $produto->produtos_id ?>">
                                        <?= $produto->produtos_id  ?> - R$ <?= number_format($produto->produtos_preco_venda, 2, ',', '.') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="quantidades[]" value="1" min="1" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger btn-remover-produto">Remover</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <button type="button" class="btn btn-secondary" id="btn-adicionar-produto">Adicionar Produto</button>
        </div>

        <div class="mb-3">
            <button class="btn btn-success" type="submit">Salvar <i class="bi bi-floppy"></i></button>
        </div>
    </form>
</div>

<script>
document.getElementById('btn-adicionar-produto').addEventListener('click', function() {
    const produtosLista = document.getElementById('produtos-lista');
    const item = document.querySelector('.produto-item').cloneNode(true);

    item.querySelector('select').value = '';
    item.querySelector('input').value = '1';

    produtosLista.appendChild(item);
});

document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('btn-remover-produto')) {
        e.target.closest('.produto-item').remove();
    }
});
</script>

<?= $this->endSection() ?>
