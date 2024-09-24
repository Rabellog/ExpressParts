<?php echo $this->element('cars/add') ?>
<?php echo $this->element('parts/add') ?>

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
    <input type="text" class="input-search" placeholder="Buscar...">
  </div>

  <div class="sale">
    <h3>Ofertas em Destaque:</h3>
    <div class="add-sale">
      <i class="fa-solid fa-plus"></i>
    </div>
  </div>

  <div class="parts">
      <div class="part">
        <div class="img"></div>
        <p>A</p>
        <span>R$1.000.000,00</span>
        <strong>R$999,99</strong>
        <button type="button" class="comprar">Comprar</button>
      </div>
    
      <div class="part">
        <div class="img"></div>
        <p>B</p>
        <span>R$1.000.000,00</span>
        <strong>R$999,99</strong>
        <button type="button" class="comprar">Comprar</button>
      </div>

      <div class="part">
        <div class="img"></div>
        <p>C</p>
        <span>R$1.000.000,00</span>
        <strong>R$999,99</strong>
        <button type="button" class="comprar">Comprar</button>
      </div>

      <div class="part">
        <div class="img"></div>
        <p>D</p>
        <span>R$1.000.000,00</span>
        <strong>R$999,99</strong>
        <button type="button" class="comprar">Comprar</button>
      </div>

      <div class="part">
        <div class="img"></div>
        <p>F</p>
        <span>R$1.000.000,00</span>
        <strong>R$999,99</strong>
        <button type="button" class="comprar">Comprar</button>
      </div>
  </div>
</main>

<?php echo $this->Html->css('home.css'); ?>

<script>
  const usuarioExiste = <?= $usuarioExiste ?>;
</script>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('cars/add.js'); ?>
<?php echo $this->Html->script('parts/add.js'); ?>
<?php echo $this->Html->script('home/home.js'); ?>
<?php $this->end(); ?>