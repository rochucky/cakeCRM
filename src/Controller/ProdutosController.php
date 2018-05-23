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
		'nome' => [
			'col' => 'nome',
			'label' => 'Nome',
			'type' => 'text',
			'required' => true
		],
		'preco' => [
			'col' => 'preco',
			'label' =>'Preço',
			'type' => 'number',
			'required' => true
		],
		'descricao' => [
			'col' => 'descricao',
			'label' => 'Descrição',
			'type' => 'text',
			'required' => false
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