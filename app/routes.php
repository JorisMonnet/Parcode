<?php

$router->define([
  //'' => 'controllers/index.php',  // by conventions all controllers are in 'controllers' folder
  '' => 'indexController',
  'index' => 'indexController',
  'index.php' => 'indexController',
  'codes' => 'codeController',
  'code' => 'codeController@show',
  'addCodes' => 'codeController@showAddView',
  'parse_add_form' => 'codeController@parseInput',
  'parse_update_form' => 'codeController@parseUpdate',
  'delete_form' => 'codeController@parseDelete',
  'login' => 'loginController@login',
  'logout' => 'loginController@logout'
]);
