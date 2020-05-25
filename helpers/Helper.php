<?php

class Helper
{
	public static function view($name, $data = []){
		extract($data); 								// La function extract importe les variables
		return require "app/views/{$name}.view.php";
	}

	public static function redirectToCodes($isDelayFailed=false){
		$path = App::get('config')['install_prefix'] ."/codes".($isDelayFailed?"?delay_failed=1":"");
		header("Location: /{$path}");
		exit();
	}

	public static function redirectCurrentPage(){
		$path = App::get('config')['install_prefix'];
		header("Location: /{$path}/".$_SESSION['currentPage']);
				exit();
	}
}
