<?php echo $this->Html->css('cars/edit-cars.css'); ?>

<?php echo $this->element('parts/add') ?>


<div class="modal fade" id="modalEditarCarros" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-body-cars">

      <div class="top-modal-cars">
        <h1>Editar carros</h1>
        <button class="fechar" type="button" data-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark fecharModal"></i>
        </button>
      </div>

      <div class="carsSearchEdit">
        <label>
          <span>Nome dos veículos:</span>
          <div class="box-modal-input searchs">
            <input type="text" id="nameCarsSearchEdit">
          </div>
        </label>
        
        <ul class="cars-viewEdit">
        </ul>

      </div>

    </div>
  </div>
</div>
<?php $this->start('scriptBottom'); ?>
<?php $this->end(); ?>