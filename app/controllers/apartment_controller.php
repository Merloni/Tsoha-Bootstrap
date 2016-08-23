<?php


class ApartmentController extends BaseController{

	public static function index(){
		$apartments = Apartment::all();

		View::make('apartment/index.html', array('apartments' => $apartments));
	}
	public static function login(){
		if(isset($_SESSION['user'])){
			Redirect::to('/', array('message' => 'Olet jo kirjautuneena sisään'));
		} else{
			View::make('apartment/login.html');	
		}
		
	}
	
	public static function handle_login(){
		$params = $_POST;

		$apartment = Apartment::authenticate($params['loginname'],$params['password']);



		if(!$apartment){
			View::make('apartment/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'loginname' => $params['loginname']));
		}else{
			$_SESSION['user'] = $apartment->id;

			Redirect::to('/', array('message' => 'Hei ' . $apartment->surname . '!'));
		}
	}
	public static function logout(){
		if (isset($_SESSION['user'])){
			$_SESSION['user'] = null;

			Redirect::to('/', array('message' => 'Onnistunut uloskirjaus'));
		}else{
			Redirect::to('/');
		}
	}


	
}