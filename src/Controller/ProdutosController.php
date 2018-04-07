<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class ProdutosController extends BaseController {

	public $controller = 'Produtos';
	
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
     * @var add -> Create
     * @var edit -> Edit
     * @var add -> Delete
     */
	public $fields = [
		'id' => ['label' => 'Id'],
		'nome' => ['label' => 'Nome'],
		'preco' => ['label' =>'Preço'],
		'descricao' => ['label' => 'Descrição']
	];

	public function index(){
		parent::load_index();
		$fields = [
			'id' => 'Id',
			'nome' => 'Nome',
			'preco' => 'Preço',  
			'descricao' => 'Descrição'  
		];

		$this->set('fields',$fields);
	}

	public function novo(){
		parent::add('produto');
		$fields = [
			'nome' => ['label' => 'Nome'],
			'preco' => ['label' =>'Preço'],
			'descricao' => ['label' => 'Descrição']
		];

		$this->set('fields',$fields);
	}

	public function excluir($id){
		parent::delete($id);
	}

	public function editar($id){
		parent::edit($id);
	}

	public function salva(){
		parent::save();
		$this->redirect('Produtos');
	}

}
?>