<section class="content-header">
  <h1>
    Part
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
            <dd><?= h($part->name) ?></dd>
            <dt scope="row"><?= __('Image') ?></dt>
            <dd><?= h($part->image) ?></dd>
            <dt scope="row"><?= __('Modified By') ?></dt>
            <dd><?= h($part->modified_by) ?></dd>
            <dt scope="row"><?= __('User') ?></dt>
            <dd><?= $part->has('user') ? $this->Html->link($part->user->name, ['controller' => 'Users', 'action' => 'view', $part->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Car') ?></dt>
            <dd><?= $part->has('car') ? $this->Html->link($part->car->name, ['controller' => 'Cars', 'action' => 'view', $part->car->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($part->id) ?></dd>
            <dt scope="row"><?= __('Price') ?></dt>
            <dd><?= $this->Number->format($part->price) ?></dd>
            <dt scope="row"><?= __('Stock') ?></dt>
            <dd><?= $this->Number->format($part->stock) ?></dd>
            <dt scope="row"><?= __('Active') ?></dt>
            <dd><?= $this->Number->format($part->active) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($part->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($part->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
