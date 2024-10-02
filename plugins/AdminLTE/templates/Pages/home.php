<?php echo $this->element('cars/add') ?>
<?php echo $this->element('cars/search-car') ?>
<?php echo $this->element('parts/add') ?>
<?php echo $this->element('parts/sale') ?>


<main>
  <img class="imageBackground" src="webroot\img\bg-page.png" alt="">
  <h1>O melhor e-commerce de peças para automóveis!</h1>
  <div class="container">
    <div class="card">
      <i class="fa-solid fa-phone"></i>
      <p>Nossa equipe especializada está pronta para ajudar você a encontrar a peça ideal. Conte conosco!</p>
      <button class="buttonCard">Suporte</button>
    </div>

    <div class="card">
      <i class="fa-solid fa-list"></i>
      <p>Explore nossa linha completa de peças automotivas com as melhores marcas e produtos. Encontre tudo o que seu carro precisa em um só lugar!</p>
      <button class="buttonCard">Catálogo</button>
    </div>

    <div class="card">
      <i class="fa-solid fa-percent"></i>
      <p>Explore nossa linha completa de peças automotivas com as melhores marcas e produtos. Encontre tudo o que seu carro precisa em um só lugar!</p>
      <button class="buttonCard">Promoções</button>
    </div>
  </div>

  <h2>ExpressParts</h2>

  <div class="search">
    <input type="text" class="input-search" id="searchParts" placeholder="Buscar...">
    <?php echo $this->Form->button(__(''), ['class' => 'fa-solid fa-magnifying-glass teste', 'id' => 'btnSearch']); ?>
  </div>


  <div class="sale">
    <h3>Ofertas em Destaque:</h3>
    <div id="adicionarDesconto">
      <i class="fa-solid fa-plus"></i>
    </div>
  </div>

  <div class="partsDiscount">
    <?php foreach ($partsDesconto as $part) { ?>
      <div class="part">
        <div class="img">
          <img src="img\parts\<?= $part->image ?>" alt="<?= $part->image ?>">
        </div>
        <p><?= $part->name ?></p>
        <span>R$ <?= $part->price ?></span>
        <strong>R$ <?= $part->priceWithDiscount ?></strong>
        <a
          href="https://wa.me/48998404930?text=Olá, gostaria de comprar o produto <?= $part->name ?>, que está na promoção e custa R$ <?= $part->priceWithDiscount ?>."
          target="_blank"
          class="comprar">
          Comprar
        </a>
      </div>
    <?php } ?>
  </div>

  <div id="catalogo" class="catalogo">
    <h3>Catálogo:</h3>
  </div>

  <div class="parts" id="parts"></div>
    <ul class="pagination" id="pagination">
    </ul>
  </div>

</main>

<?php echo $this->Html->css('home.css'); ?>

<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('cars/add.js'); ?>
<?php echo $this->Html->script('cars/search-car.js'); ?>
<?php echo $this->Html->script('parts/add.js'); ?>
<?php echo $this->Html->script('parts/sale.js'); ?>
<?php echo $this->Html->script('home/home.js'); ?>
<?php $this->end(); ?>