<?php 
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\DefaultPasswordHasher;

class Base extends Entity  {

	protected $_accessible = [
		'*' => true,
		'id' => false
	];

	public function _setPassword($password){
		return (new DefaultPasswordHasher)->hash($password);
	}

}

 ?>