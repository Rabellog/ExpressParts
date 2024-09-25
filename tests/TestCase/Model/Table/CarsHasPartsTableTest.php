<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CarsHasPartsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CarsHasPartsTable Test Case
 */
class CarsHasPartsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CarsHasPartsTable
     */
    protected $CarsHasParts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CarsHasParts',
        'app.Parts',
        'app.Cars',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CarsHasParts') ? [] : ['className' => CarsHasPartsTable::class];
        $this->CarsHasParts = $this->getTableLocator()->get('CarsHasParts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CarsHasParts);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CarsHasPartsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
