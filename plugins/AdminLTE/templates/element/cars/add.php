<?php echo $this->Html->css('add-cars.css'); ?>

<div class="modal fade" id="modalAdicionarCarros" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-body-cars">

        <div class="top-modal-cars">
          <h1>Carros</h1>
          <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
        
        <?php echo $this->Form->create(null, ['role' => 'form', 'url' => ['controller' => 'Cars', 'action' => 'add']]); ?>
    
          <div class="modal-body-form-cars">
            <div class="form-carros">
            <label>
              <span>Nome:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-car-rear"></i>
                </span>
                <input type="text" name="name" id="name">
              </div>
            </label>

            <label>
              <span>Marca:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-car-burst"></i>
                </span>
                <input type="text" name="brand" id="brand">
              </div>
            </label>

            <label>
              <span>Modelo:</span>
              <div class="box-modal-input">
              <span class="box-modal-icon">
                <i class="fa-solid fa-car-on"></i>
                </span>
                <input type="text" name="model" id="model">
              </div>
            </label>

            <?php echo $this->Form->button(__(' Salvar'), ['class' => 'button-adicionar', 'type' => 'submit']); ?>
            </div>
          </div>

        <?php echo $this->Form->end(); ?>

      </div>
    </div>
  </div>

