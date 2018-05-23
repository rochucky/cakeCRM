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

		$this->setMenus();
		$this->setFields();

		$join = [];
		foreach ($this->joins['Form'] as $val){
			$joinTable = TableRegistry::get($val);
			$join[$val] = $joinTable->find('all');
		}		

		$this->set('username', $this->Auth->user('username'));
		$this->set('usertype', $this->Auth->user('type'));
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
		
		$this->setFields();

		if($this->Auth->user('type') == 'recycle'){
			$conditions = array('conditions'=>array(array('not' => array($this->controller.'.deleted is null'))));	
			
				
		}
		else{
			$conditions = array('conditions'=>array($this->controller.'.deleted is null'));
		}

		$table = TableRegistry::get($this->controller);
		$items = $table->find('all', $conditions);
		$items->contain($this->joins['Main']);

		$data['data'] = array();

		foreach($items as $item){
			$array['rowid'] = $item->id;
			foreach($this->fields as $field_name => $field_params){
				$col = $field_params['col'];
				if(isset($field_params['format'])){
					if($field_params['format'] == 'datetime'){
						$array[] = '<span name="'.$col.'">'.date('d/m/Y H:i:s', strtotime($item->$col->nice())).'</span>';
					}
				}
				else if ($field_params['type'] == 'join'){
					$joinName = $field_params['joinName'];
					$joinCol = $field_params['joinCol'];
					$array[] = '<span name="'.$col.'" data-id="'.$item->$joinName->id.'">'.$item->$joinName->$joinCol.'</span>';
				}
				else if ($field_params['type'] == 'boolean'){
					$boolean[0] = 'Não';
					$boolean[1] = 'Sim';
					$array[] = '<span name="'.$col.'" data-id="'.(($item->$col) ? '1': '0').'">'.$boolean[$item->$col].'</span>';
				}
				else{
					$array[] = '<span name="'.$col.'">'.$item->$col.'</span>';
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
     * Delete record
     *
     * @param $id - record id
     * 
     */

	public function delete(){

		$table = TableRegistry::get($this->controller);
		$data = $this->request->data();
		
		$response = [
			'success' => 0,
			'error' => 0
		];

		foreach($data['ids'] as $id){
			$item = $table->get($id);
			$item->deleted = date('Y-m-d H:i:s');
			$item->deleted_by = $this->Auth->user('id');


			if($table->save($item)){
				$response['success']++;
			}
			else{
				$response['error']++;
			}
		}
		$this->response->body(json_encode($response));
		return $this->response;
	}

	/**
     * Restore deleted record
     *
     * @param $id - record id
     * 
     */

	public function restore(){

		$table = TableRegistry::get($this->controller);
		$data = $this->request->data();
		
		$response = [
			'success' => 0,
			'error' => 0
		];

		foreach($data['ids'] as $id){
			$item = $table->get($id);
			$item->deleted = NULL;
			$item->deleted_by = NULL;


			if($table->save($item)){
				$response['success']++;
			}
			else{
				$response['error']++;
			}
		}
		$this->response->body(json_encode($response));
		return $this->response;

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
						if($this->controller = 'Users'){
							$item->password = '123456';
						}
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

	// Set default fields
	private function setFields(){
		$this->fields['modified'] = [
			'col' => 'modified',
			'label' => 'Alterado Em',
			'format' => 'datetime',
			'readonly' => true,
			'required' => false
		];
		$this->fields['modified_by'] = [
			'col' => 'modified_by',
			'label' => 'Alterado Por',
			'type' => 'join',
			'joinController' => 'Users',
			'joinCol' => 'name',
			'joinName' => 'modified_by_data',
			'readonly' => true,
			'required' => false
		];
		$this->fields['created'] = [
			'col' => 'created',
			'label' => 'Criado Em',
			'format' => 'datetime',
			'readonly' => true,
			'required' => false
		];
		$this->fields['created_by'] = [
			'col' => 'created_by',
			'label' => 'Criado Por',
			'type' => 'join',
			'joinController' => 'Users',
			'joinCol' => 'name',
			'joinName' => 'created_by_data',
			'readonly' => true,
			'required' => false
		];
		if($this->Auth->user('type') == 'recycle'){
			$this->fields['deleted'] = [
				'col' => 'deleted',
				'label' => 'Excluido Em',
				'format' => 'datetime'
			];
			$this->fields['deleted_by'] = [
				'col' => 'deleted_by',
				'label' => 'Excluido Por',
				'type' => 'join',
				'joinController' => 'Users',
				'joinCol' => 'name',
				'joinName' => 'deleted_by_data'
			];
		}
	}

	public function setMenus(){

		$menu = [
			'Produtos' => 'produtos',
			'Clientes' => [
				'Cadastro de Clientes' => 'clientes',
				'Produtos/Clientes' => 'produtos'
			],
			'Admin' => [
				'Usuários' => 'users',
				'Tipos de usuários' => 'userTypes'
			]
		];

		$this->set('menus', $menu);

	}

}
?>