<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CarsFixture
 */
class CarsFixture extends TestFixture
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
                'brand' => 'Lorem ipsum dolor sit amet',
                'model' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'created' => '2024-09-17 14:40:49',
                'modified' => '2024-09-17 14:40:49',
                'modified_by' => 'Lorem ipsum dolor sit amet',
                'users_id' => 1,
            ],
        ];
        parent::init();
    }
}
