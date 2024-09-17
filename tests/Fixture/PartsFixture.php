<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartsFixture
 */
class PartsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'image' => 'Lorem ipsum dolor sit amet',
                'preco' => 1,
                'quantity' => 1,
                'active' => 1,
                'created' => '2024-09-17 14:40:57',
                'modified' => '2024-09-17 14:40:57',
                'modified_by' => 'Lorem ipsum dolor sit amet',
                'users_id' => 1,
                'cars_id' => 1,
            ],
        ];
        parent::init();
    }
}
