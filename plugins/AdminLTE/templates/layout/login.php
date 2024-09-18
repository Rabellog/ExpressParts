<?= $this->Form->create() ?>   

<form class="form-login">
  <h1>Acesso Administrativo</h1>

  <label for="">
    <span> Nome de usuário:</span>
    <div class="box-user"><i></i></div>
    <input name="username" id="username" type="text">
  </label>

  <label for="">
    <span> Senha do usuário:</span>
    <div class="input-name">
    <div class="box-user"><i></i></div>
    <input name="password" id="password" type="password">
    </div>
  </label>

  <?= $this->Form->button(__('Acessar')); ?>
</form>
<?= $this->Form->end() ?>
<?php echo $this->Html->css('login.css'); ?>