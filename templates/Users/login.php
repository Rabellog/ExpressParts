<?php $this->layout = 'AdminLTE.login'; ?>
<?= $this->Flash->render('auth') ?>
<?= $this->Flash->render() ?>

<?= $this->Form->create($user) ?>    

<label for="">
    <span>Nome de usuário:</span>
    <div class="box-user"><i></i></div>
    <input name="username" type="text">
  </label>
    <?= $this->Form->input('username', ['type' => 'text']); ?>
</label>

<label for="">
    <span>Senha do usuário:</span>
    <div class="box-user"><i></i></div>
    <input name="password" type="password">
  </label>
    <?= $this->Form->input('password', ['type' => 'password']); ?>
</label>

<?= $this->Form->button(__('Acessar')); ?>
<?= $this->Form->end(); ?>
