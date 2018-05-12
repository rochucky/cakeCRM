<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class UsersController extends BaseController {

	public $controller = 'Users';
	public $title = 'Usuário';
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
		'name' => [
			'label' => 'Nome',
			'type' => 'text',
		],
		'email' => [
			'label' => 'E-mail',
			'type' => 'email'
		],
		'username' => [
			'label' => 'Usuário',
			'type' => 'text'
		],
		'user_type_id' => [
			'label' => 'Tipo',
			'type' => 'join',
			'joinController' => 'UserTypes',
			'joinCol' => 'name',
			'joinName' => 'user_type'
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
		],
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
		]
	];

	public $joins = [
		'Main' => ['UserTypes', 'CreatedByData', 'ModifiedByData'],
		'Form' => ['UserTypes', 'Users']
	];

	public function index(){
		parent::load_index();
	}

	public function novo(){
		$this->set('title', 'Criar '.$this->title);
		$this->fields['password'] = ['label' => 'Senha', "type" => "password"];
		parent::add(strtolower($this->controller));
	}

	public function excluir($id){
		parent::delete($id);
	}

	public function editar($id){
		$this->set('title', 'Criar '.$this->title);
		parent::edit($id);
	}

	public function salvar(){
		parent::save();
		$this->redirect($this->controller);
	}
	public function login(){

		if ($this->request->is('post')){
			$user = $this->Auth->identify();
			
			if($user){
				$userTypesTable = TableRegistry::get('UserTypes');
				$userType = $userTypesTable->get($user['user_type_id']);
				$user['type'] = $userType->name;

				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			else{
				$this->Flash->error('Usuário ou senha inválidos');
			}
		}
		else{
			if($this->Auth->user()){
				return $this->redirect($this->Auth->redirectUrl());
			}
		}

    }

    public function logout(){
    	$this->redirect($this->Auth->logout());
    }
}
?>