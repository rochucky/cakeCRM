<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class GenericController extends BaseController {


	public $controller = 'Controller'; // Used Controller
	public $title = 'Controller'; // Page Top title
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
     * @label -> field label ro be shown on screen
     * @format -> data format
     * @readonly -> if exists, field will  be readonly
     * @
     *
     *
     */
	public $fields = [
		'created' => [
			'label' => 'Criado Em',
			'format' => 'datetime',
			'readonly' => true
		],
		'created_by' => [
			'label' => 'Criado Por',
			'type' => 'join',
			'joinController' => 'Users',
			'joinCol' => 'name',
			'joinName' => 'created_by_data',
			'readonly' => true
		],
		'modified' => [
			'label' => 'Alterado Em',
			'format' => 'datetime',
			'readonly' => true
		],
		'modified_by' => [
			'label' => 'Alterado Por',
			'type' => 'join',
			'joinController' => 'Users',
			'joinCol' => 'name',
			'joinName' => 'modified_by_data',
			'readonly' => true
		]
	];

	public $joins = [
		'Main' => [],
		'Form' => []
	];	

	public function index(){
		$this->set('title', $this->title);
		parent::load_index();
	}

	public function novo(){
		$this->set('title', 'Criar '.$this->title);
		parent::add(strtolower($this->controller));
	}

	public function excluir($id){
		parent::delete($id);
	}

	public function editar($id){
		$this->set('title', 'Editar '.$this->title);
		parent::edit($id);
	}

	public function salvar(){
		parent::save();
		$this->redirect($this->controller);
	}

}
?>