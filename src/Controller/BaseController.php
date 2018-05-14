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

		$join = [];
		foreach ($this->joins['Form'] as $val){
			$joinTable = TableRegistry::get($val);
			$join[$val] = $joinTable->find('all');
		}

		$this->set($var, $items);
		$this->set('joins',$join);
		$this->set('controller',$this->controller);
		$this->set('add',$this->permission['add']);
		$this->set('edit',$this->permission['edit']);
		$this->set('del',$this->permission['del']);
		$this->set('fields',$this->fields);
		$this->set('title',$this->title);
		$this->render('/Layout/main');
	
	}

	public function getData(){
		
		$table = TableRegistry::get($this->controller);
		$items = $table->find('all');
		$items->contain($this->joins['Main']);

		$data['data'] = array();
		foreach($items as $item){
			$array['rowid'] = $item->id;
			foreach($this->fields as $field_name => $field_params){
				if(isset($field_params['format'])){
					if($field_params['format'] == 'datetime'){
						$array[] = '<span name="'.$field_name.'">'.date('d/m/Y H:i:s', strtotime($item->$field_name->nice())).'</span>';
					}
				}
				else if ($field_params['type'] == 'join'){
					$joinName = $field_params['joinName'];
					$joinCol = $field_params['joinCol'];
					$array[] = '<span name="'.$field_name.'" data-id="'.$item->$joinName->id.'">'.$item->$joinName->$joinCol.'</span>';
				}
				else{
					$array[] = '<span name="'.$field_name.'">'.$item->$field_name.'</span>';
				}
			}
			
			$data['data'][] = $array;
			unset($array);
		}
		// var_dump($data);
		$this->response->body(json_encode($data));
		return $this->response;
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
			$this->response->body('ok');
		}
		else{
			$this->response->body(json_encode($table));
		}
		return $this->response;
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

		if($this->request->is('post')){
		
			if($this->Auth->user()){
				try{
					$table = TableRegistry::get($this->controller);
					$item = $table->newEntity($this->request->data());
					if(!$item->id){
						$item->created_by = $this->Auth->user('id');
					}
					$item->modified_by = $this->Auth->user('id');
					
					if ($table->saveOrFail($item)){
						$this->response->body("ok");
						return $this->response;
					}
				}
				catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
				    if(strstr($e, '_isUnique')){
				    	$this->response->body('unique_error');
				    }
				    return $this->response;
				}
			}
			else{
				$this->response->body('403');
				return $this->response;
			}
		}
	}

}
?>