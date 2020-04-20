<?php

/**
 *
 */
class Helper
{
  public static function display($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
  }
    // dd = display & die
	public static function dd($data){
		Helper::display($data);
		die();
	}
    // Dynamically require a view
  public static function view($name, $data = []){
      extract($data); // La function extract importe les variables
                        // dans la table des symboles
      return require "app/views/{$name}.view.php";
  }
  public static function redirect($redirectToCodes,$isDelayFailed=false){
      $path = App::get('config')['install_prefix'] . ($redirectToCodes?"/codes":"").($isDelayFailed?"?delay_failed=1":"");
      header("Location: /{$path}");
      exit();
  }
  public static function redirectCurrentPage(){
      $path = App::get('config')['install_prefix'];
			header("Location: /{$path}/".$_SESSION['currentPage']);
			exit();
  }
}
