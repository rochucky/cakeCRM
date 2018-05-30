<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class ProdutosClientesController extends BaseController {

	public $controller = 'ProdutosClientes';
	public $title = 'Produtos';
	
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
		'id_produto' => [
			'col' => 'id_produto',
			'label' => 'Produto',
			'type' => 'join',
			'joinController' => 'Produtos',
			'joinCol' => 'nome',
			'joinName' => 'produto'
		],
		'id_cliente' => [
			'col' => 'id_cliente',
			'label' => 'Cliente',
			'type' => 'join',
			'joinController' => 'Clientes',
			'joinCol' => 'name',
			'joinName' => 'cliente'
		]
	];

	public $joins = [
		'Main' => ['CreatedByData','ModifiedByData','DeletedByData','Produtos','Clientes'],
		'Form' => ['Users','Produtos','Clientes']
	];

	public $applets =  [
		'Clientes' => [
			'title' => 'Clientes',
			'child' => [
				'controller' => 'ProdutosClientes',
				'link' => 'id_cliente'
			]
		],
		'ProdutosClientes' => [
			'title' => 'Produtos'
		]
	];

	public function index(){
		parent::load_index();
	}
}
?>