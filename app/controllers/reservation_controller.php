<?php

class ReservationController extends BaseController{
	
	
	public static function index(){

		$reservations = Reservation::all();

		View::make( 'reservation/index.html', array('reservations' => $reservations));

	}
	public static function show($id){
		$reservation = Reservation::find($id);	

		$apartment = Apartment::find($reservation->apartment_id);

		View::make('reservation/show.html', array('reservation' => $reservation, 'apartment' => $apartment));
	}
	public static function create(){

		View::make('reservation/new.html');

	}
	public static function edit($id){
		$reservation = Reservation::find($id);

		View::make('reservation/edit.html', array('attributes' => $reservation));
	}
	public static function update($id){
		$params = $_POST;


		$attributes = array(
			'id' => $id,
			'apartment_id' => $params['apartment_id'],
			'reserved' => $params['reserved'],
			'reservehour' => $params['reservehour']
		);

		$reservation = new Reservation($attributes);
		$reservation ->update();
		Redirect::to('/reservation/' . $reservation->id, array('message' => 'Muokattu onnistuneesti'));

	}
	public static function store(){
    
    	$params = $_POST;
    
    	$reservation = new Reservation(array(
      		'apartment_id' => $params['apartment_id']
    	));

    	$reservation->save();

    
    	Redirect::to('/reservation/' . $reservation->id, array('message' => 'Varaus tehty!'));
  	}
  	public static function destroy($id){
  		$reservation = new Reservation(array('id' => $id));
  		$reservation->destroy();

  		Redirect::to('/reservation', array('message' => 'Poistettu'));

  	}
}