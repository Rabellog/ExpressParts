<?php echo $this->Html->css('parts/edit-parts.css'); ?>

<div class="modal fade" id="modalEditarPecas" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel">
  <div class="modal-dialog">
    <div class="modal-body-parts">

      <div class="top-modal-parts">
        <h1>Peças</h1>
        <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <?php echo $this->Form->create(null, ['id' => 'formPartEdit', 'role' => 'form', 'type' => 'file', 'url' => ['controller' => 'Parts', 'action' => 'edit']]); ?>

      <div class="modal-body-form-parts">

        <input type="hidden" id="selectedPartId" name="partId">

        <div class="modal-input-img">
          <label for="imageEdit" class="input-img" id="dropAreaEdit">
            <i id="iconeEdit" class="fa-solid fa-file-circle-plus"></i>
            <img id="imagePreviewEdit" src="" alt="imagePreview" class="imagePreviewEdit" hidden>
            <input type="file" id="imageEdit" name="imageEdit" class="anexoEdit" accept=".jpg, .jpeg, .png">
          </label>
          <label for="imageEdit" class="buttonAnexo">Alterar foto</label>
        </div>

        <fieldset>
          <div class="labels-parts">
            <label>
              <span>Nome:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-car-side"></i>
                </span>
                <input type="text" name="name" id="namePart" class="namePart">
              </div>
            </label>

            <label>
              <span>Estoque:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-box-open"></i>
                </span>
                <input type="number" name="stock" id="stock" class="stock">
              </div>
            </label>

            <label>
              <span>Valor:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-tag"></i>
                </span>
                <input type="number" name="price" id="price" class="price">
              </div>
            </label>
          </div>
          <?php echo $this->Form->button(__('Editar'), ['class' => 'button-adicionar', 'id' => 'editar']); ?>
        </fieldset>

        <div class="carsSearch">
          <label>
            <span>Nome dos veículos:</span>
            <div class="box-modal-input searchs">
              <input type="text" id="nameCarsSearchEdit" class="nameCarsSearchEdit">
            </div>
          </label>

          <ul id="carsResultEdit" class="carsResultEdit">
          </ul>


          <ul class="cars-viewEdit" id="cars-viewEdit">
          </ul>

        </div>
      </div>
   

    </div>

    <?php echo $this->Form->end(); ?>

  </div>
</div>
</div>