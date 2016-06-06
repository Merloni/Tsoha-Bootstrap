<?php

class Reservation extends BaseMode{

	public $id, $apartment_id, $reserved, $reservehour, $time;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Reservation');

		$query.execute();

		$rows = $query->fetchAll();
		$reserations = array();

		foreach($rows as $row){
			$reservations[] = new Reservation(array(
				'id' => $row['id'],
				'apartment_id' => $row['apartment_id'],
				'reserved' => $row['reserved'],
				'reservehour' => $row['reservehour'],
				'time' => $row['time']
				));
		}
		return reservations;
	}
	

}