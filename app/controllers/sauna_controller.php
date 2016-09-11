<?php


class SaunaController extends BaseController{

	public static function index(){
		self::check_logged_in();

		$saunas = Sauna::all();

		View::make('sauna/index.html', array('saunas' => $saunas));
	}
	public static function show($id){
		self::check_logged_in();


		$sauna = Sauna::find($id);
		View::make('sauna/show.html', array('sauna' => $sauna));
		
	}
	public static function create(){
		self::check_logged_in();

		View::make('sauna/new.html');
	}

	public static function store(){
		self::check_logged_in();
    
    	$params = $_POST;

    	$attributes = array(
      		'name' => $params['name'],
      		'address' => $params['address'],
      		'price' => $params['price']
    	);
    	$sauna = New Sauna($attributes);
    	$errors = $sauna->errors();

    	if (count($errors) == 0) {
    		$sauna->save();
    		Redirect::to('/saunas', array('message' => 'Sauna luotu!'));
    	}else{
    		View::make('/sauna/new.html', array('errors' => $errors, 'sauna' => $sauna));
  		}
  	}
	public static function edit($id){
		self::check_logged_in();

		if (Sauna::find($id)){
			$sauna = Sauna::find($id);

			View::make('/sauna/edit.html', array('sauna' => $sauna));

		}else{
			Redirect::to('/saunas', array('message' => 'Virheellinen ID'));

		}
	}
	public static function update($id){
		self::check_logged_in();

		$params = $_POST;


		$attributes = array(
			'id' => $id,
			'name' => $params['name'],
			'address' => $params['address'],
			'price' =>  $params['price']
		);

		$sauna = new Sauna($attributes);
		$errors = $sauna->errors();
		if(count($errors) > 0){
			View::make('sauna/edit.html', array('errors' => $errors, 'sauna' => $sauna));
		}else{
			$sauna->update();
			Redirect::to('/sauna/' . $sauna->id, array('message' => 'Muokattu onnistuneesti'));
		}
		

	}
  	public static function destroy($id){
		self::check_logged_in();


		$reservations = Reservation::all();
		foreach($reservations as $res){
			if ($res->sauna_id == $id){
				$res->destroy();
			}
		}
  		$sauna = new Sauna(array('id' => $id));
  		$sauna->destroy();

  		Redirect::to('/saunas', array('message' => 'Poistettu'));

  	}

	
}