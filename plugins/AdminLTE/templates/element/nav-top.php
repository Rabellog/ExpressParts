<?php echo $this->Html->css('layout/nav.css'); ?>

<nav>
    <ul>
        <li><a href="#" id="catalogoNav" onclick="window.location.href='<?php echo $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']); ?>'">Ver Catálogo</a></li>
        <li><a href="#" id="adicionarCarros">Adicionar carro</a></li>
        <li><a href="#" id="adicionarPecas">Adicionar peça</a></li>
        <li><a href="#" id="editarCarros" onclick="window.location.href='<?php echo $this->Url->build(['controller' => 'Cars', 'action' => 'carsList']); ?>'">Editar carros</a>
    </ul>
    <button class="login" onclick="window.location.href='<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'login']); ?>'">Acesso Administrativo</button>
    <button class="logout" onclick="window.location.href='<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>'">Logout</button>
</nav>
<script>
    const usuarioExiste = <?= $usuarioExiste ?>;
</script>
<?php echo $this->Html->css('nav.css'); ?>