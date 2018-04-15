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
		'nome' => ['label' => 'Nome'],
		'preco' => ['label' =>'Preço'],
		'descricao' => ['label' => 'Descrição']
	];

	public function index(){
		parent::load_index();
	}

	public function novo(){
		parent::add($this->controller);
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