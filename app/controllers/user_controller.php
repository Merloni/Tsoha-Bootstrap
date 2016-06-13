<?php

class UserController extends BaseController{

	public static function login(){
		View::make('user/login.html');
	}
	public static function handle_login(){
		$params = $_POST;

		$user = User::authenticate($params[''])
	}


}
