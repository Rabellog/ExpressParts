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
 * @property float $preco
 * @property int $quantity
 * @property int $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $modified_by
 * @property int $users_id
 * @property int $cars_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Car $car
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
        'preco' => true,
        'quantity' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'modified_by' => true,
        'users_id' => true,
        'cars_id' => true,
        'user' => true,
        'car' => true,
    ];
}
