<?php

class Reservation extends BaseModel{

	public $id, $apartment_id, $sauna_id, $reserved, $reservestart, $reserve_end;

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
				'sauna_id' => $row['sauna_id'],
				'reserved' => $row['reserved'],
				'reservestart'=>$row['reservestart'],
				'reserve_end'=>$row['reserve_end']
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
				'sauna_id'=> $row['sauna_id'],
				'reserved'=> $row['reserved'],
				'reservestart'=>$row['reservestart'],
				'reserve_end'=>$row['reserve_end']
				));

			return $reservation;
		}
		return null;
	}

	public function save(){

    	$query = DB::connection()->prepare('INSERT INTO Reservation (apartment_id, sauna_id, reserved, reservestart, reserve_end) VALUES (:apartment_id, :reserved, :reservestart, :reserve_end) RETURNING id');

    	$query->execute(array('apartment_id' => $this->apartment_id, 'sauna_id' => $this->sauna_id, 'reserved' => $this->reserved, 'reservestart' => $this->reservestart, 'reserve_end' => $this->reserve_end));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
  	public function update(){

  		$query = DB::connection()->prepare('UPDATE Reservation (apartment_id, sauna_id, reserved, reservestart, reserve_end) VALUES (:apartment_id, :reserved, :reservestart, :reserve_end) RETURNING id');

  		$query->execute(array('apartment_id' => $this->apartment_id, 'sauna_id' => $this->sauna_id, 'reserved' => $this->reserved, 'reservestart' => $this->reservestart, 'reserve_end' => $this->reserve_end));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
  	public function destroy(){

  		$query = DB::connection()->prepare('DELETE FROM Reservation (apartment_id, sauna_id, reserved, reservestart, reserve_end) VALUES (:apartment_id, :reserved, :reservestart, :reserve_end) RETURNING id');

  		$query->execute(array('apartment_id' => $this->apartment_id, 'sauna_id' => $this->sauna_id, 'reserved' => $this->reserved, 'reservestart' => $this->reservestart, 'reserve_end' => $this->reserve_end));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}


	

}