<?php

class ReservationController extends BaseController{
	
	
	public static function index(){

		$reservations = Reservation::all();

		View::make( 'reservation/index.html', array('reservations' => $reservations));

	}
	public static function show($id){
		$reservation = Reservation::find($id);	
		

		$apartment = Apartment::find($reservation->apartment_id);

		View::make('reservation/show.html', compact('reservation', 'apartment'));
	}
	public static function create(){

		View::make('reservation/new.html');

	}
	public static function edit($id){
		$reservation = Reservation::find($id);

		View::make('reservation/edit.html', array('reservation' => $reservation));
	}
	public static function update($id){
		$params = $_POST;


		$attributes = array(
			'id' => $id,
			'apartment_id' => $params['apartment_id'],
			'sauna_id' =>  $params['sauna_id'],
			'reserved' => $params['reserved'],
			'reservestart' => $params['reservestart'],
			'reserve_end' => $params['reserve_end']
		);

		$reservation = new Reservation($attributes);
		$errors = $reservation->errors();
		if(count($errors) > 0){
			View::make('reservation/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}else{
			$reservation ->update();
			Redirect::to('/reservation/' . $reservation->id, array('message' => 'Muokattu onnistuneesti'));
		}
		

	}
	public static function store(){
    
    	$params = $_POST;

    	$attributes = array(
      		'apartment_id' => $params['apartment_id'],
      		'sauna_id' => $params['sauna_id'],
      		'reserved' => $params['reserved'],
      		'reservestart' => $params['reservestart'],
      		'reserve_end' => $params['reserve_end']
    	);
    	$reservation = New Reservation($attributes);

    	$errors = $reservation->errors();

    	if (count($errors) == 0) {
    		$reservation->save();
    		Redirect::to('/reservation/' . $reservation->id, array('message' => 'Varaus tehty!'));
    	}else{
    		View::make('reservation/new.html', array('errors' => $errors, 'attributes' => $attributes));
  		}

    
    	
  	}
  	public static function destroy($id){
  		$reservation = new Reservation(array('id' => $id));
  		$reservation->destroy();

  		Redirect::to('/reservation', array('message' => 'Poistettu'));

  	}
}