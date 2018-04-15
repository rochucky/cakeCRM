<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class UsersController extends BaseController {

	public $controller = 'Users';
	
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
		'name' => ['label' => 'Nome'],
		'email' => ['label' =>'E-mail'],
		'username' => ['label' => 'Usuário']
	];

	public function index(){
		parent::load_index();
	}

	public function novo(){
		$this->fields['password'] = ['label' => 'Senha', "type" => "password"];
		parent::add(strtolower($this->controller));
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
	public function login(){

		if ($this->request->is('post')){
			$user = $this->Auth->identify();

			if($user){
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