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
}
