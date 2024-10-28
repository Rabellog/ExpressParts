<?php echo $this->element('cars/add') ?>
<?php echo $this->element('cars/edit') ?>
<?php echo $this->element('cars/search-car') ?>
<?php echo $this->element('parts/add') ?>
<?php echo $this->element('parts/edit') ?>
<?php echo $this->element('parts/delete') ?>
<?php echo $this->element('parts/sale') ?>

<main>
  <img class="imageBackground" src="webroot\img\bg-page.png" alt="">
  <h1>O melhor e-commerce de peças para automóveis!</h1>
  <div class="container">
    <div class="card">
      <i class="fa-solid fa-phone"></i>
      <p>Conte com nossa equipe especializada para encontrar a peça perfeita para o seu carro. Estamos prontos para ajudar você!</p>
      <a href="https://wa.me/5548996186913?text=Olá%2C%20preciso%20de%20suporte." target="_blank" class="suporte">
        <button class="buttonCardSuporte">Suporte</button>
      </a>
    </div>

    <div class="card">
      <i class="fa-solid fa-percent"></i>
      <p>Encontre as peças automotivas que você precisa, com descontos especiais e produtos de alta qualidade!</p>
      <button class="buttonCard" id="buttonPromocoes">Promoções</button>
    </div>

    <div class="card">
      <i class="fa-solid fa-list"></i>
      <p>Descubra nossa linha completa de peças automotivas. Tudo o que o seu carro precisa, você encontra em um só lugar!</p>
      <button class="buttonCard" id="buttonCatalogo">Catálogo</button>
    </div>
  </div>

  <h2>ExpressParts</h2>

  <div class="search">
    <input type="text" class="input-search" id="searchParts" placeholder="Buscar...">
    <?php echo $this->Form->button(__(''), ['class' => 'fa-solid fa-magnifying-glass lupa', 'id' => 'btnSearch']); ?>
  </div>


  <div class="sale" id="sale">
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
        <div id="values">
          <span>R$ <?= $part->price ?></span>
          <strong>R$ <?= $part->priceWithDiscount ?></strong>
        </div>
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


</main>

<?php echo $this->Html->css('layout/home.css'); ?>
<?php echo $this->Html->css('global-styles.css'); ?>

<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('cars/edit.js'); ?>
<?php echo $this->Html->script('parts/add.js'); ?>
<?php echo $this->Html->script('parts/edit.js'); ?>
<?php echo $this->Html->script('parts/delete.js'); ?>
<?php echo $this->Html->script('parts/sale.js'); ?>
<?php echo $this->Html->script('home/home.js'); ?>
<?php $this->end(); ?>