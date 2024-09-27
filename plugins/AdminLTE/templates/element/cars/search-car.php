<?php echo $this->Html->css('search-car.css'); ?>

<div class="modal fade" id="modalPesquisarPecas" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel">
    <div class="modal-dialog">
        <div class="modal-body-parts">

            <div class="top-modal-parts">
                <h1>Pesquisa de peças pelo carro</h1>
                <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <?php echo $this->Form->create(null, ['role' => 'form', 'type' => 'file', 'url' => ['controller' => 'Parts', 'action' => 'add']]); ?>
        
            <div id="pesquisaDePecasPorCarros">
                <div class="infoCars">
                    <label>
                        <span>Nome do carro:</span>
                        <input type="text">
                    </label>
                    <label>
                        <span>Marca do carro:</span>
                        <input type="text">
                    </label>
                    <label>
                        <span>Modelo do carro:</span>
                        <input type="text">
                    </label>

                    <button>Salvar</button>
                </div>

                <div class="avaibleCars">
                    <ul class="view-avaible">
                        <li>
                            <span>Teste</span>
                            <button>Teste</button>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <?php echo $this->Form->end(); ?>

    </div>
</div>
</div>