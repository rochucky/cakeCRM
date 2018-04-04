<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class ProdutosController extends BaseController {

	public $controller = 'Produtos';

	public function index(){

		$produtosTable = TableRegistry::get('Produtos');
		$produtos = $produtosTable->find('all');

		$this->set('msg', 'Bom dia');
		$this->set('produtos', $produtos);
	}

	public function novo(){
		parent::add('produto');
	}

	public function excluir($id){
		parent::delete($id);
	}

	public function editar($id){

		parent::edit($id);
		// $produtosTable = TableRegistry::get('Produtos');

		// $produto = $produtosTable->get($id);
		// $this->set('produto', $produto);
		// $this->render('novo');
	}

	public function salva(){

		parent::save();

		// $produtosTable = TableRegistry::get('Produtos');
		// $produto = $produtosTable->newEntity($this->request->data());

		// if ($produtosTable->save($produto)){
		// 	$msg = "Registro salvo com sucesso!";
		// 	$this->Flash->set($msg, ['element' => 'success']);
		// }
		// else{
		// 	$msg = "Erro ao inserir Registro";
		// 	$this->Flash->set($msg, ['element' => 'error']);
		// }

		$this->redirect('Produtos/index');
	}

}
?>