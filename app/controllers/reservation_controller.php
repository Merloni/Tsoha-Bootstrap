<?php

class ReservationController extends BaseController{
	
	
	public static function index(){

		$reservations = Reservation::all();

		View::make( 'reservation/index.html', array('reservations' => $reservations));

	}
	public static function show($id){

		$reservation = Reservation::find($id);

		View::make('reservation/show.html', array('reservation' => $reservation));

	}
	public static function create(){

		View::make('login.html');

	}
	public static function store(){
    
    	$params = $_POST;
    
    	$reservation = new Reservation(array(
      		'apartment_id' => $params['apartment_id']
    	));

    	$reservation->save();

    
    	Redirect::to('/reservation/' . $reservation->id, array('message' => 'Varaus tehty!'));
  }
}