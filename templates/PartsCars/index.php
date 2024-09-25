<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\PartsCar> $partsCars
 */
?>
<div class="partsCars index content">
    <?= $this->Html->link(__('New Parts Car'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Parts Cars') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('parts_id') ?></th>
                    <th><?= $this->Paginator->sort('cars_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partsCars as $partsCar): ?>
                <tr>
                    <td><?= $partsCar->has('part') ? $this->Html->link($partsCar->part->name, ['controller' => 'Parts', 'action' => 'view', $partsCar->part->id]) : '' ?></td>
                    <td><?= $partsCar->has('car') ? $this->Html->link($partsCar->car->name, ['controller' => 'Cars', 'action' => 'view', $partsCar->car->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $partsCar->parts_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partsCar->parts_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partsCar->parts_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partsCar->parts_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
