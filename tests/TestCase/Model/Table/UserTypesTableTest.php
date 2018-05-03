<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserTypesTable Test Case
 */
class UserTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserTypesTable
     */
    public $UserTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_types',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserTypes') ? [] : ['className' => UserTypesTable::class];
        $this->UserTypes = TableRegistry::get('UserTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
