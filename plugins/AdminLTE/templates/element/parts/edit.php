<?php echo $this->Html->css('parts/edit-parts.css'); ?>

<?php echo $this->element('parts/add') ?>


<div class="modal fade" id="modalEditarPecas" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-body-parts">

      <div class="top-modal-parts">
        <h1>Editar peças</h1>
        <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="partsSearchEdit">
        <label>
          <span>Nome dos veículos:</span>
          <div class="box-modal-input searchs">
            <input type="text" id="namePartsSearchEdit">
          </div>
        </label>
        
        <ul class="parts-viewEdit">
        <li>
          <input type="hidden" value="teste" name="teste">
          <span>teste</span>
          <div><i class="fa-solid fa-trash"></i>
          <span type="button" id="aadicionarPecass">
            <i class="fa-solid fa-pen"></i>
          </span>
        </div>
      </li>
        </ul>

      </div>

    </div>
  </div>
</div>
<?php $this->start('scriptBottom'); ?>
<?php $this->end(); ?>