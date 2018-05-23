<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class UserTypesController extends BaseController {

	public $controller = 'UserTypes';
	public $title = 'Tipo de Usuário';
	
	/**
     * Module Permissions CRUD
     * @var add -> Create
     * @var edit -> Edit
     * @var add -> Delete
     */
	public $permission = [
		'add' => 0,
		'edit' => 0,
		'del' => 0
	];


	/**
     * Fields to be used on screen
     */
	public $fields = [
		'id' => [
			'col' => 'id',
			'label' => 'Id',
			'type' => 'text'
		],
		'name' => [
			'col' => 'name',
			'label' => 'Nome',
			'type' => 'text'
		]
	];

	public $joins = [
		'Main' => ['CreatedByData','ModifiedByData'],
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