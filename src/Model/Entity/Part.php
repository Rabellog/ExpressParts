<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Part Entity
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property float $price
 * @property int $stock
 * @property int|null $discount
 * @property int $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $modified_by
 * @property int $users_id
 *
 * @property \App\Model\Entity\User $user
 */
class Part extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'image' => true,
        'price' => true,
        'stock' => true,
        'discount' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'modified_by' => true,
        'users_id' => true,
        'user' => true,
        'cars' => true,
    ];
}
