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
                    <label>
                    <span>Pesquisa por peças</span>
                    <input type="text" name="namePartsSearch" id="namePartsSearch">
                    </label>

                    <ul id="partsResult">
                    </ul>

                    <div class="promos">
                        <span>Promoção (%):</span>
                        <input type="number" id="partDiscountValue" placeholder="0" step="0.01" min="0" max="100">
                    </div>

                    <button class="saveDiscount">Salvar</button>

                </div>

                <div class="partsInfo">
                    <label>
                    <span>Nome da peça:</span>
                    <input type="text" id="partDiscountName" disabled>
                    </label>
                   
                    <label>
                    <span>Valor da peça:</span>
                    <input type="number" id="partDiscountPrice" disabled>
                    </label>
                   
                    <label>
                    <span>Estoque da peça:</span>
                    <input type="number" id="partDiscountStock" disabled>
                    </label>

                </div>

            </div>

        </div>

        <?php echo $this->Form->end(); ?>

    </div>
</div>
</div>