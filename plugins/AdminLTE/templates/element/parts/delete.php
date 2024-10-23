<?php echo $this->Html->css('parts/delete-parts.css'); ?>

<div class="modal fade" id="modalConfirmacaoExclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-body-parts-delete">
            <div class="top-modal-parts-delete">
                <h1>Confirmar Exclusão</h1>
            </div>

            <input type="hidden" id="selectedPartId" name="partId">

            <?php echo $this->Form->create(null, ['id' => 'formPartDelete', 'role' => 'form', 'type' => 'file', 'url' => ['controller' => 'Parts', 'action' => 'desativarPeca']]); ?>

            <div class="modal-body-form-parts-delete">
                <p>Tem certeza que deseja excluir esta peça do banco de dados?</p>
                <div class="confirmacao">
                    <button type="button" class="btn-voltar" data-dismiss="modal">Cancelar</button>
                    <?php echo $this->Form->button(__('Confirmar'), ['class' => 'btn-excluir', 'id' => 'excluir']); ?>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>