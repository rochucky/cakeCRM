<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class ProdutosClientesController extends BaseController {

	public $controller = 'ProdutosClientes';
	public $title = 'Cliente';
	
	/**
     * Module Permissions CRUD
     * @var add -> Create
     * @var edit -> Edit
     * @var add -> Delete
     */
	public $permission = [
		'add' => 1,
		'edit' => 1,
		'del' => 1
	];


	/**
     * Fields to be used on screen
     */
	public $fields = [
		'name' => [
			'col' => 'name',
			'label' => 'Nome',
			'type' => 'text',
			'required' => true
		],
		'cnpj' => [
			'col' => 'cnpj',
			'label' =>'CNPJ',
			'type' => 'text',
			'required' => true
		],
		'is_active' => [
			'col' => 'is_active',
			'label' => 'Ativo?',
			'type' => 'boolean',
			'required' => true
		],
	];

	public $joins = [
		'Main' => ['CreatedByData','ModifiedByData', 'DeletedByData'],
		'Form' => ['Users']
	];

	public $applets =  [
		'Clientes' => [
			'title' => 'Clientes'
		],
		'Produtos' => [
			'title' => 'Produtos'
		]
	];

	public function index(){
		parent::load_index();
	}
}
?>