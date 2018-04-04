<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class BaseController extends AppController {

	public function add($var){

		$table = TableRegistry::get($this->controller);

		$item = $table->newEntity();

		$this->set($var,$item);
	}

	public function delete($id){

		$table = TableRegistry::get($this->controller);

		$item = $table->get($id);
		
		if($table->delete($item)){
			$msg = 'Registro excluido';
			$this->Flash->set($msg, ['element' => 'error']);
		}
		else{
			$msg = 'Erro ao excluir registro';
			$this->Flash->set($msg, ['element' => 'error']);
		}

		$this->redirect($this->controller);

	}

	public function edit($id){

		$table = TableRegistry::get($this->controller);

		$item = $table->get($id);
		$this->set('item', $item);
		$this->render('novo');
	}

	public function save(){

		$table = TableRegistry::get($this->controller);
		$item = $table->newEntity($this->request->data());

		if ($table->save($item)){
			$msg = "Registro salvo com sucesso!";
			$this->Flash->set($msg, ['element' => 'success']);
		}
		else{
			$msg = "Erro ao inserir Registro";
			$this->Flash->set($msg, ['element' => 'error']);
		}

		$this->redirect($this->controller);
	}

}
?>