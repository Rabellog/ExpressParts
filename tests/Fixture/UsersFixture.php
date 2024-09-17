<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'role' => 1,
                'active' => 1,
                'created' => '2024-09-17 14:40:44',
                'modified' => '2024-09-17 14:40:44',
                'modified_by' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
