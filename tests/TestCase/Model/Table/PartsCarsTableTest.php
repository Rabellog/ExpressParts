<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartsCarsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartsCarsTable Test Case
 */
class PartsCarsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartsCarsTable
     */
    protected $PartsCars;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PartsCars',
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
        $config = $this->getTableLocator()->exists('PartsCars') ? [] : ['className' => PartsCarsTable::class];
        $this->PartsCars = $this->getTableLocator()->get('PartsCars', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PartsCars);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PartsCarsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
