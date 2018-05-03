<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class BaseController extends AppController {

	/**
     * Loads index table data
     *
     * @param $var - name of variable to be used in the view
     * 
     */
	public function load_index($var = 'items'){

		$table = TableRegistry::get($this->controller);
		$items = $table->find('all');
			$items->contain($this->joins['Main']);
		$this->set($var, $items);
		$this->set('controller',$this->controller);
		$this->set('add',$this->permission['add']);
		$this->set('edit',$this->permission['edit']);
		$this->set('del',$this->permission['del']);
		$this->set('fields',$this->fields);
		$this->set('title',$this->title);
		$this->render('/Layout/main');
	
	}

	/**
     * Fetch new record to add a data in the table
     * 
     */
	public function add(){

		$table = TableRegistry::get($this->controller);
		$item = $table->newEntity();
		$join = [];
		foreach ($this->joins['Form'] as $val){
			$joinTable = TableRegistry::get($val);
			$join[$val] = $joinTable->find('all');
		}
			

		$this->set('item',$item);
		$this->set('controller',$this->controller);
		$this->set('fields',$this->fields);
		$this->set('joins',$join);
		$this->set('title','Criar '.$this->title);
		$this->set('back',$this->request->referer());
		$this->render('/Layout/form');

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
			$this->Flash->success('Registro excluido');
		}
		else{
			$this->Flash->error('Erro ao excluir registro');
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
		$join = [];
		foreach ($this->joins['Form'] as $val){
			$joinTable = TableRegistry::get($val);
			$join[$val] = $joinTable->find('all');
		}

		$this->set('item', $item);
		$this->set('controller',$this->controller);
		$this->set('fields',$this->fields);
		$this->set('joins',$join);
		$this->set('title','Editar '.$this->title);
		$this->render('/Layout/form');
	}

	/**
     * Save data to the table
     * 
     */

	public function save(){

		$table = TableRegistry::get($this->controller);
		$item = $table->newEntity($this->request->data());
		if(!$item->id){
			$item->created_by = $this->Auth->user('id');
		}
		$item->modified_by = $this->Auth->user('id');
		
		if ($table->save($item)){
			$this->Flash->success("Registro salvo com sucesso!");
		}
		else{
			$this->Flash->error("Erro ao inserir Registro");
		}
	}

}
?>