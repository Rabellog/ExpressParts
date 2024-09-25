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
                'price' => 1,
                'stock' => 1,
                'discount' => 1,
                'active' => 1,
                'created' => '2024-09-24 19:10:01',
                'modified' => '2024-09-24 19:10:01',
                'modified_by' => 'Lorem ipsum dolor sit amet',
                'users_id' => 1,
                'cars_id' => 1,
            ],
        ];
        parent::init();
    }
}
