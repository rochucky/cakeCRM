<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class ProdutosController extends BaseController {


	public $controller = 'Produtos';
	public $title = 'Produto';
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
		'nome' => ['label' => 'Nome'],
		'preco' => [
			'label' =>'Preço',
			'type' => 'number'
		],
		'descricao' => ['label' => 'Descrição'],
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
		],
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
		]
	];

	public $joins = [
		'Main' => ['CreatedByData','ModifiedByData'],
		'Form' => ['Users']
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