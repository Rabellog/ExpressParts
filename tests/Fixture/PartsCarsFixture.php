<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartsCarsFixture
 */
class PartsCarsFixture extends TestFixture
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
                'parts_id' => 1,
                'cars_id' => 1,
            ],
        ];
        parent::init();
    }
}
