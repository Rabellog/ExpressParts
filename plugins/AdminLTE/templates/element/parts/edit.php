<?php echo $this->Html->css('parts/edit-pecas.css'); ?>

<?php echo $this->element('cars/add') ?>


<div class="modal fade" id="modalEditarPecas" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-body-cars">

      <div class="top-modal-cars">
        <h1>Editar peças</h1>
        <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <?php echo $this->Form->create(null, ['role' => 'form', 'url' => ['controller' => 'Cars', 'action' => 'add']]); ?>

      <div class="modal-body-form-cars">
        <div class="form-carros">

          <label>
            <span>Nome da peça:</span>
            <div class="box-modal-input">
              <input type="text" name="name" id="nameEditCar">
            </div>
          </label>

          <div class="edit-view-cars">
            <ul class="edit-results-cars">
              <li class="edit-result-car">
                <p>Teste</p>
                <div class="xesque">
                <i class="fa-solid fa-trash"></i>
                <span type="button" id="aadicionarPecas">
                  <i class="fa-solid fa-pen"></i>
                </span>
                </div>
              </li>
            </ul>
          </div>x
        </div>
      </div>

      <?php echo $this->Form->end(); ?>

    </div>
  </div>
</div>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('cars/add.js'); ?>
<?php $this->end(); ?>