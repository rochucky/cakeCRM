<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class ClientesController extends BaseController {

	public $controller = 'Clientes';
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
			'label' => 'Nome',
			'type' => 'text'
		],
		'cnpj' => [
			'label' =>'CNPJ',
			'type' => 'text'
		],
		'is_active' => [
			'label' => 'Ativo?',
			'type' => 'boolean'
		],
		'modified' => [
			'label' => 'Alterado Em',
			'format' => 'datetime',
			'readonly' => true
		]
	];

	public $joins = [
		'Main' => ['CreatedByData','ModifiedByData', 'DeletedByData'],
		'Form' => ['Users']
	];

	public function index(){
		parent::load_index();
	}

	public function novo(){
		parent::add(strtolower($this->controller));
	}

	public function excluir($id){
		parent::delete($id);
	}

	public function editar($id){
		parent::edit($id);
	}

	public function salvar(){
		parent::save();
		$this->redirect($this->controller);
	}
}
?>