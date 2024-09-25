<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartsCar $partsCar
 * @var string[]|\Cake\Collection\CollectionInterface $parts
 * @var string[]|\Cake\Collection\CollectionInterface $cars
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $partsCar->parts_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $partsCar->parts_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Parts Cars'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="partsCars form content">
            <?= $this->Form->create($partsCar) ?>
            <fieldset>
                <legend><?= __('Edit Parts Car') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
