<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartsCar $partsCar
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Parts Car'), ['action' => 'edit', $partsCar->parts_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Parts Car'), ['action' => 'delete', $partsCar->parts_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partsCar->parts_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Parts Cars'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Parts Car'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="partsCars view content">
            <h3><?= h($partsCar->Array) ?></h3>
            <table>
                <tr>
                    <th><?= __('Part') ?></th>
                    <td><?= $partsCar->has('part') ? $this->Html->link($partsCar->part->name, ['controller' => 'Parts', 'action' => 'view', $partsCar->part->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Car') ?></th>
                    <td><?= $partsCar->has('car') ? $this->Html->link($partsCar->car->name, ['controller' => 'Cars', 'action' => 'view', $partsCar->car->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
