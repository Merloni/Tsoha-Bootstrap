<?php

class Reservation extends BaseModel{

	public $id, $apartment_id, $reserved, $reservehour;

	public function __construct($attributes){
		parent::__construct($attributes);
	}
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Reservation');

		$query->execute();

		$rows = $query->fetchAll();
		$reservations = array();

		foreach($rows as $row){
			$reservations[] = new Reservation(array(
				'id' => $row['id'],
				'apartment_id' => $row['apartment_id'],
				'reserved' => $row['reserved'],
				'reservehour' => $row['reservehour']
				));
		}
		return $reservations;
	}
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Reservation WHERE id = :id LIMIT 1');

		$query->execute(array('id' => $id));

		$row = $query->fetch();

		if($row){
			$reservation = new Reservation(array(
				'id'=> $row['id'],
				'apartment_id'=> $row['apartment_id'],
				'reserved'=> $row['reserved'],
				'reservehour'=>$row['reservehour']
				));

			return $reservation;
		}
		return null;
	}

	public function save(){

    	$query = DB::connection()->prepare('INSERT INTO Reservation (apartment_id, reserved, reservehour) VALUES (:apartment_id, :reserved, :reservehour) RETURNING id');

    	$query->execute(array('apartment_id' => $this->apartment_id, 'reserved' => $this->reserved, 'reservehour' => $this->reservehour));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
  	public function update(){

  		$query = DB::connection()->prepare('UPDATE Reservation (apartment_id, reserved, reservehour) VALUES (:apartment_id, :reserved, :reservehour) RETURNING id');

  		$query->execute(array('apartment_id' => $this->apartment_id, 'reserved' => $this->reserved, 'reservehour' => $this->reservehour));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
  	public function destroy(){

  		$query = DB::connection()->prepare('DELETE Reservation (apartment_id, reserved, reservehour) VALUES (:apartment_id, :reserved, :reservehour) RETURNING id');

  		$query->execute(array('apartment_id' => $this->apartment_id, 'reserved' => $this->reserved, 'reservehour' => $this->reservehour));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}


	

}