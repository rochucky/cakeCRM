<?php 
namespace App\View\Helper;

use Cake\View\Helper;	

class CurrencyHelper extends Helper {

	public function format($number) {

		return "R$ ".number_format($number,2,",",".");
	}

}

 ?>