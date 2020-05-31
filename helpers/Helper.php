<?php

/**
 * Very useful class, it allows to redirect to a view with some data 
 * or to redirect to a defined page
 */
class Helper
{
	public static function view($name, $data = []){
		extract($data); 								// extract function import the variables
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
