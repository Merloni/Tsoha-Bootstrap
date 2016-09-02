<?php

class Reservation extends BaseModel{

	public $id, $apartment_id, $sauna_id, $reserved, $reservestart, $reserve_end;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_start_and_endtime');
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
	public static function allown(){
		$query = DB::connection()->prepare('SELECT * FROM Reservation WHERE apartment_id = :apartment_id');

		$query->execute(array('apartment_id' => $_SESSION['user']));

		$rows = $query->fetchAll();
		$reservations = array();
		foreach($rows as $row){
			$reservations[] = new Reservation(array(
				'id' => $row['id'],
				'apartment_id' => $row['apartment_id'],
				'sauna_id' => $row['sauna_id'],
				'reserved' => $row['reserved'],
				'reservestart' => $row['reservestart'],
				'reserve_end' => $row['reserve_end']
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

    	$query = DB::connection()->prepare('INSERT INTO Reservation (apartment_id, sauna_id, reserved, reservestart, reserve_end) VALUES (:apartment_id, :sauna_id, :reserved, :reservestart, :reserve_end) RETURNING id');

    	$query->execute(array('apartment_id' => $this->apartment_id, 'sauna_id' => $this->sauna_id, 'reserved' => $this->reserved, 'reservestart' => $this->reservestart, 'reserve_end' => $this->reserve_end));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
  	public function update(){

  		$query = DB::connection()->prepare('UPDATE Reservation SET apartment_id = :apartment_id, sauna_id = :sauna_id, reserved = :reserved, reservestart = :reservestart, reserve_end = :reserve_end WHERE id = :id RETURNING id');

      $query->execute(array('id' => $this->id, 'apartment_id' => $this->apartment_id, 'sauna_id' => $this->sauna_id, 'reserved' => $this->reserved, 'reservestart' => $this->reservestart, 'reserve_end' => $this->reserve_end));

      $row = $query->fetch();
    
      $this->id = $row['id'];

  	}
  	public function destroy(){

  		$query = DB::connection()->prepare('DELETE FROM Reservation WHERE id = :id');

  		$query->execute(array('id' => $this->id));


  	}
  	public function reservedtostring(){
  		if ($this->reserved){
  			return "Varattu";
  		} else {
  			return "Vapaa";
  		}
  	}
  	public function validate_start_and_endtime(){
  		$errors = array();
  		if($this->reservestart == '' || $this->reserve_end == '' || $this->reservestart == null || $this->reserve_end == null){
  			$errors[] = 'Varauksella on oltava alku -ja loppuaika';

  		}

  		if ($this->reservestart > $this->reserve_end){
  			$errors[] = 'Alkuajan on oltava ennen loppuaikaa';
  		}
  		return $errors;

  	}
  	public function validate_sauna_id(){
  		$errors = array();
  		if($this->sauna_id == '' || $this->sauna_id == null){
  			$errors[] = 'Sauna id ei voi olla tyhjä';
  		}
  		if(is_numeric($this->sauna_id) == 0){
  			$errors[] = 'Sauna id on oltava numero';
  		}
  	}


	

}