<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartsCar $partsCar
 * @var \Cake\Collection\CollectionInterface|string[] $parts
 * @var \Cake\Collection\CollectionInterface|string[] $cars
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Parts Cars'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="partsCars form content">
            <?= $this->Form->create($partsCar) ?>
            <fieldset>
                <legend><?= __('Add Parts Car') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
