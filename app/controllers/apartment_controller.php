<?php


class ApartmentController extends BaseController{

	public static function index(){
		$apartments = Apartment::all();

		View::make('apartment/index.html', array('apartments' => $apartments));
	}

	
}