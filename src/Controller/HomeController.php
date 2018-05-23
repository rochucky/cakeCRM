<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class HomeController extends BaseController {

	public $controller = 'Home';

	public function index(){
		$this->set('user', $this->Auth->User('name'));
		$this->setMenus();
		// parent::load_index();
	}

	public function novo(){
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

    }
}
?>