<?php echo $this->Html->css('layout/nav.css'); ?>

<nav>
    <ul>
        <li><a href="#" id="catalogoNav">Ver Catálogo</a></li>
        <li><a href="https://wa.me/5548996186913?text=Olá%2C%20preciso%20de%20suporte." target="_blank">Suporte</a></li>
        <li><a href="#" id="adicionarCarros">Adicionar carro</a></li>
        <li><a href="#" id="adicionarPecas">Adicionar peça</a></li>
        <li><a href="#" onclick="window.location.href='cars/carsList'" id="editarCarros">Editar carros</a><
    </ul>
    <button class="login" onclick="window.location.href='login'">Acesso Administrativo</button>
    <button class="logout" onclick="window.location.href='users/logout'">Logout</button>
</nav>
<script>
    const usuarioExiste = <?= $usuarioExiste ?>;
</script>
<?php echo $this->Html->css('nav.css'); ?>