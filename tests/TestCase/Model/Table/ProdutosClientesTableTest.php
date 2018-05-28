<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProdutosClientesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProdutosClientesTable Test Case
 */
class ProdutosClientesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProdutosClientesTable
     */
    public $ProdutosClientes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.produtos_clientes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProdutosClientes') ? [] : ['className' => ProdutosClientesTable::class];
        $this->ProdutosClientes = TableRegistry::get('ProdutosClientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProdutosClientes);

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
