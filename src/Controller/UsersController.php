<?php 
namespace App\Controller;

use Cake\ORM\TableRegistry;

class UsersController extends BaseController {

	public $controller = 'Users';

	public function index(){

	}

	public function novo(){
		parent::add('user');
	}

	public function salvar(){
		parent::save();
	}
}
?>