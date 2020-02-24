<?php

$router->define([
  //'' => 'controllers/index.php',  // by conventions all controllers are in 'controllers' folder
  '' => 'IndexController',
  'index' => 'IndexController',
  'index.php' => 'IndexController',
  'about' => 'AboutController',
  'tasks' => 'TaskController',
  'task' => 'TaskController@show',
  'add_task' => 'TaskController@showAddView',
  'parse_add_form' => 'TaskController@parseInput',
  'update_task' => 'TaskController@update',
  'parse_update_form' => 'TaskController@parseUpdate',
  'delete_form' => 'TaskController@parseDelete',
  'login' => 'LoginController@login',
  'logout' => 'LoginController@logout'
]);
