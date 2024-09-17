<section class="content-header">
  <h1>
    Car
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($car->name) ?></dd>
            <dt scope="row"><?= __('Brand') ?></dt>
            <dd><?= h($car->brand) ?></dd>
            <dt scope="row"><?= __('Model') ?></dt>
            <dd><?= h($car->model) ?></dd>
            <dt scope="row"><?= __('Modified By') ?></dt>
            <dd><?= h($car->modified_by) ?></dd>
            <dt scope="row"><?= __('User') ?></dt>
            <dd><?= $car->has('user') ? $this->Html->link($car->user->name, ['controller' => 'Users', 'action' => 'view', $car->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($car->id) ?></dd>
            <dt scope="row"><?= __('Active') ?></dt>
            <dd><?= $this->Number->format($car->active) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($car->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($car->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
