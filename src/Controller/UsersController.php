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
		'add' => 0,
		'edit' => 0,
		'del' => 0
	];


	/**
     * Fields to be used on screen
     */
	public $fields = [
		'name' => [
			'col' => 'name',
			'label' => 'Nome',
			'type' => 'text',
		],
		'email' => [
			'col' => 'email',
			'label' => 'E-mail',
			'type' => 'email'
		],
		'username' => [
			'col'  => 'username',
			'label' => 'Usuário',
			'type' => 'text'
		],
		'user_type' => [
			'col' => 'user_type_id',
			'label' => 'Tipo',
			'type' => 'join',
			'joinController' => 'UserTypes',
			'joinCol' => 'name',
			'joinName' => 'user_type'
		],
		'is_active' => [
			'col' => 'is_active',
			'label' => 'Ativo?',
			'type' => 'boolean'
		]
	];

	public $joins = [
		'Main' => ['UserTypes', 'CreatedByData', 'ModifiedByData'],
		'Form' => ['UserTypes', 'Users']
	];

	public function index(){

		parent::load_index();
	}

	// public function novo(){
	// 	$this->set('title', 'Criar '.$this->title);
		
	// 	parent::add(strtolower($this->controller));
	// }

	// public function excluir($id){
	// 	parent::delete($id);
	// }

	// public function editar($id){
	// 	$this->set('title', 'Criar '.$this->title);
	// 	parent::edit($id);
	// }

	// public function salvar(){
	// 	parent::save();
	// 	$this->redirect($this->controller);
	// }
	public function login(){

		if ($this->request->is('post')){
			$user = $this->Auth->identify();
			
			if($user){
				$userTypesTable = TableRegistry::get('UserTypes');
				$userType = $userTypesTable->get($user['user_type_id']);
				$user['type'] = $userType->name;

				$this->Auth->setUser($user);
				if($this->request->here == '/'){ // From login page
					return $this->redirect($this->Auth->redirectUrl());
				}else{ // From modal
					$this->response->body('success');
					return $this->response;
				}
			}
			else{
				if($this->request->here == '/'){ // From login page
					$this->Flash->error('Usuário ou senha inválidos');
				}else{ // From modal
					$this->response->body('login_error');
					return $this->response;
				}
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