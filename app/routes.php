<?php

$router->define([
	'' => 'IndexController',
	'index' => 'IndexController',
	'index.php' => 'IndexController',
	'codes' => 'CodeController',
	'code' => 'CodeController@show',
	'addCode' => 'CodeController@showAddView',
	'addForm' => 'CodeController@parseAdd',
	'updateForm' => 'CodeController@parseUpdate',
	'deleteCode' => 'CodeController@parseDelete',
	'login' => 'LoginController@login',
	'logout' => 'LoginController@logout',
	'loginPage' => 'LoginController@loginPage',
	'parseFormSort' => 'CodeController@parseSort',
	'addComment' => 'CommentController@parseAdd',
	'updateComment' => 'CommentController@parseUpdate',
	'deleteComment' => 'CommentController@parseDelete',
	'codeUpdate' => 'CodeController@showEdit',
	'loginCancel' => 'LoginController@cancel',
	'showSignUp' => 'LoginController@showSignUp',
	'signUpCancel' => 'LoginController@loginPage',
	'signUp' => 'LoginController@signUp',
	'updateVotes' => 'CommentController@updateVotes'
]);
