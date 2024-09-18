<?php $this->layout = 'AdminLTE.login'; ?>
<?= $this->Flash->render('auth') ?>
<?= $this->Flash->render() ?>

<?= $this->Form->create() ?>    
<form action="">
  <label for="">
    <span>Nome de usuário:</span>
    <div class="box-user"><i></i></div>
    <input name="" type="text">
  </label>

  
  <label for="">
    <span>Senha do usuário:</span>
    <div class="box-user"><i></i></div>
    <input type="password">
  </label>

  <?= $this->Form->button(__('Acessar')); ?>
</form>
<?= $this->Form->end() ?>