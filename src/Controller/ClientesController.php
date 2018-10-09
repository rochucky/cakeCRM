<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class ClientesController extends BaseController {

	public $controller = 'Clientes';
	public $title = 'Cliente';
	public $customScript = true;
	
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
			'required' => true,
			'mask' => 'cnpj'
		],
		'is_active' => [
			'col' => 'is_active',
			'label' => 'Ativo?',
			'type' => 'boolean',
			'required' => true
		],
	];

	public $joins = [
		'Main' => ['CreatedByData','ModifiedByData','DeletedByData'],
		'Form' => ['Users']
	];

	public $applets =  [
		'Clientes' => [
			'title' => 'Clientes',
			'controller' => 'ProdutosController'
		]

	];

	public function index(){
		parent::load_index();
	}
}
?>