<?php echo $this->Html->css('add-sales.css'); ?>

<div class="modal fade" id="modalAdicionarPromos" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel">
    <div class="modal-dialog">
        <div class="modal-body-parts">

            <div class="top-modal-parts">
                <h1>Ofertas</h1>
                <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <?php echo $this->Form->create(null, ['role' => 'form', 'type' => 'file', 'url' => ['controller' => 'Parts', 'action' => 'add']]); ?>

            <div id="ofertas">

                <div class="partsSearch">
                    <span>Pesquisa por peças</span>
                    <input type="text" name="namePartsSearch" id="namePartsSearch">

                    <ul id="partsResult">
                        <li title="aaa" data-id="1" class="part-item">AAAA</li>
                    </ul>

                    <span>Promoção (%):</span>
                    <input type="number" id="discount">

                    <p>Desconto aplicado:</p>
                    <span id="applyDiscount">10R$</span>
                </div>

                <div class="partsInfo">
                    <span>Nome da peça:</span>
                    <input type="text" id="name">

                    <span>Valor da peça:</span>
                    <input type="number" id="price">

                    <span>Estoque da peça:</span>
                    <input type="number" id="stock">

                </div>

            </div>

        </div>

        <?php echo $this->Form->end(); ?>

    </div>
</div>
</div>