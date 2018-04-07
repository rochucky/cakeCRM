<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class BaseController extends AppController {

	public $home = 'Produtos';

	/**
     * Loads index table data
     *
     * @param $var - name of variable to be used in the view
     * 
     */
	public function load_index($var = 'items'){

		$table = TableRegistry::get($this->controller);
		$items = $table->find('all');

		$this->set($var, $items);
		$this->set('controller',strtolower($this->controller));
		$this->set('add',$this->permission['add']);
		$this->set('edit',$this->permission['edit']);
		$this->set('del',$this->permission['del']);
		$this->set('fields',$this->fields);
	
	}

	/**
     * Fetch new record to add a data in the table
     * 
     */
	public function add(){

		$table = TableRegistry::get($this->controller);
		$item = $table->newEntity();

		$this->set('item',$item);
		$this->set('controller',strtolower($this->controller));
		$this->set('fields',$this->fields);

	}

	/**
     * Delete record
     *
     * @param $id - record id
     * 
     */

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

	/**
     * Get record to edit
     *
     * @param $id - record id
     * 
     */

	public function edit($id){

		$table = TableRegistry::get($this->controller);

		$item = $table->get($id);
		$this->set('item', $item);
		$this->set('controller',strtolower($this->controller));
		$this->set('fields',$this->fields);
		$this->render('novo');
	}

	/**
     * Save data to the table
     * 
     */

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
	}

}
?>