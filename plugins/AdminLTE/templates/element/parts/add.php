<?php echo $this->Html->css('add-parts.css'); ?>

<div class="modal fade" id="modalAdicionarPecas" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel">
  <div class="modal-dialog">
    <div class="modal-body-parts">

      <div class="top-modal-parts">
        <h1>Peças</h1>
        <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <?php echo $this->Form->create(null, ['role' => 'form', 'type' => 'file', 'url' => ['controller' => 'Parts', 'action' => 'add']]); ?>

      <div class="modal-body-form-parts">

        <div class="modal-input-img">
          <label for="image" class="input-img">
            <i class="fa-regular fa-file-image"></i>
            <p>Arraste aqui!</p>
            <input type="file" id="image" name="image" class="anexo" accept=".jpg, .jpeg, .png">
          </label>
          <label for="image" class="buttonAnexo">Alterar foto</label>
        </div>

        <fieldset>
          <div class="labels-parts">
            <label>
              <span>Nome:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-car-side"></i>
                </span>
                <input type="text" name="namePart" id="namePart">
              </div>
            </label>

            <label>
              <span>Estoque:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-box-open"></i>
                </span>
                <input type="number" name="stock" id="stock">
              </div>
            </label>

            <label>
              <span>Valor:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-tag"></i>
                </span>
                <input type="number" name="price" id="price">
              </div>
            </label>
          </div>
          <?php echo $this->Form->button(__('Adicionar'), ['class' => 'button-adicionar']); ?>
        </fieldset>

        <div class="carsSearch">
          <label>
            <span>Nome dos veículos:</span>
            <div class="box-modal-input searchs">
              <input type="text" name="nameCarsSearch" id="nameCarsSearch">
            </div>
          </label>

          <ul id="carsResult">
          </ul>


          <ul class="cars-view">
          </ul>

        </div>
      </div>



    </div>

    <?php echo $this->Form->end(); ?>

  </div>
</div>
</div>