<?php 
namespace App\View\Helper;

use Cake\View\Helper;	

class FormatHelper extends Helper {

	public function currency($number) {

		return "R$ ".number_format($number,2,",",".");
	}

	public function datetime($var){
		if($var)
			return date('d/m/Y H:i:s', strtotime($var));
		else
			return '';
	}

}

 ?>