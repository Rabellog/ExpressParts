<?php echo $this->Html->css('add-cars.css'); ?>

<div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-body">

        <div class="top-modal">
          <h1>Adicionar carros</h1>
          <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
        
        <?php echo $this->Form->create(null, ['role' => 'form', 'url' => ['controller' => 'Cars', 'action' => 'add']]); ?>

          <div class="modal-body-form">
            <label>
              <span>Nome do carro:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-car-rear"></i>
                </span>
                <input type="text" name="nameCar" id="nameCar">
              </div>
            </label>

            <label>
              <span>Marca do carro:</span>
              <div class="box-modal-input">
                <span class="box-modal-icon">
                  <i class="fa-solid fa-car-burst"></i>
                </span>
                <input type="text" name="mark" id="mark">
              </div>
            </label>

            <label>
              <span>Modelo do carro:</span>
              <div class="box-modal-input">
              <span class="box-modal-icon">
                <i class="fa-solid fa-car-on"></i>
                </span>
                <input type="text" name="model" id="model">
              </div>
            </label>

            <?php echo $this->Form->button(__('Adicionar'), ['class' => 'button-adicionar']); ?>
          </div>

        <?php echo $this->Form->end(); ?>

      </div>
    </div>
  </div>

<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('cars/add.js'); ?>
<?php $this->end(); ?>