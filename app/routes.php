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
	'codeUpdate' => 'CodeController@showEdit',
	'parseFormSort' => 'CodeController@parseSort',

	'login' => 'LoginController@login',
	'logout' => 'LoginController@logout',
	'loginPage' => 'LoginController@loginPage',
	'loginCancel' => 'LoginController@cancel',
	'showSignUp' => 'LoginController@showSignUp',
	'signUpCancel' => 'LoginController@loginPage',
	'signUp' => 'LoginController@signUp',

	'addComment' => 'CommentController@parseAdd',
	'updateComment' => 'CommentController@parseUpdate',
	'deleteComment' => 'CommentController@parseDelete',
	'updateVotes' => 'CommentController@updateVotes'
]);
