<?php

class Reservation extends BaseModel{

	public $id, $apartment_id, $sauna_id, $day, $reserve_start, $reserve_end;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_start_and_endtime', 'validate_sauna');
	}
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Reservation ORDER BY day, reserve_start');

		$query->execute();

		$rows = $query->fetchAll();
		$reservations = array();

		foreach($rows as $row){
			$reservations[] = new Reservation(array(
				'id' => $row['id'],
				'apartment_id' => $row['apartment_id'],
				'sauna_id' => $row['sauna_id'],
				'day' => $row['day'],
				'reserve_start'=>$row['reserve_start'],
				'reserve_end'=>$row['reserve_end']
				));
		}
		return $reservations;
	}
	public static function allwithday($day){
		$query = DB::connection()->prepare('SELECT * FROM Reservation WHERE day = :day ORDER BY day, reserve_start');

		$query->execute(array('day' => $day));

		$rows = $query->fetchAll();
		$reservations = array();
		foreach($rows as $row){
			$reservations[] = new Reservation(array(
				'id' => $row['id'],
				'apartment_id' => $row['apartment_id'],
				'sauna_id' => $row['sauna_id'],
				'day' => $row['day'],
				'reserve_start' => $row['reserve_start'],
				'reserve_end' => $row['reserve_end']
				));
		}
		return $reservations;
	}
	public static function allown(){
		$query = DB::connection()->prepare('SELECT * FROM Reservation WHERE apartment_id = :apartment_id ORDER BY day, reserve_start');

		$query->execute(array('apartment_id' => $_SESSION['user']));

		$rows = $query->fetchAll();
		$reservations = array();
		foreach($rows as $row){
			$reservations[] = new Reservation(array(
				'id' => $row['id'],
				'apartment_id' => $row['apartment_id'],
				'sauna_id' => $row['sauna_id'],
				'day' => $row['day'],
				'reserve_start' => $row['reserve_start'],
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
				'day' => $row['day'],
				'reserve_start'=>$row['reserve_start'],
				'reserve_end'=>$row['reserve_end']
				));

			return $reservation;
		}
		return null;
	}

	public function save(){

    	$query = DB::connection()->prepare('INSERT INTO Reservation (apartment_id, sauna_id, day, reserve_start, reserve_end) VALUES (:apartment_id, :sauna_id, :day, :reserve_start, :reserve_end) RETURNING id');

    	$query->execute(array('apartment_id' => $this->apartment_id, 'sauna_id' => $this->sauna_id, 'day' => $this->day, 'reserve_start' => $this->reserve_start, 'reserve_end' => $this->reserve_end));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
  	public function update(){

  		$query = DB::connection()->prepare('UPDATE Reservation SET apartment_id = :apartment_id, sauna_id = :sauna_id,
  			day = :day, reserve_start = :reserve_start, reserve_end = :reserve_end WHERE id = :id RETURNING id');

      $query->execute(array('id' => $this->id, 'apartment_id' => $this->apartment_id, 'sauna_id' => $this->sauna_id, 'day' => $this->day, 'reserve_start' => $this->reserve_start, 'reserve_end' => $this->reserve_end));

      $row = $query->fetch();
    
      $this->id = $row['id'];

  	}
  	public function destroy(){

  		$query = DB::connection()->prepare('DELETE FROM Reservation WHERE id = :id');

  		$query->execute(array('id' => $this->id));


  	}
  	public function validate_start_and_endtime(){
  		$errors = array();
  		if($this->reserve_start == '' || $this->reserve_end == '' || $this->reserve_start == null || $this->reserve_end == null){
  			$errors[] = 'Varauksella on oltava alku -ja loppuaika';

  		}
  		if ($this->reserve_start > $this->reserve_end){
  			$errors[] = 'Alkuajan on oltava ennen loppuaikaa';
  		}
  		return $errors;

  	}
  	public function validate_sauna(){
  		$errors = array();
  		$reservations = Reservation::allwithday($this->day);

  		foreach($reservations as $res){

  			if($res->sauna_id == $this->sauna_id){
  				$r_start =  substr($res->reserve_start, 0, 5);
  				$r_end = substr($res->reserve_end, 0, 5);
  				if($r_start <= $this->reserve_start && $r_end > $this->reserve_start){
  					$errors[] = "Päällekkäinen varaus";
  				} else if ($r_start >= $this->reserve_start && $r_end <= $this->reserve_end){
  					$errors[] = "Päällekkäinen varaus";
  				} else if ($r_end >= $this->reserve_end && $r_start < $this->reserve_end){
  					$errors[] = "Päällekkäinen varaus";
  				}
  			}
  		
  		}

  		return $errors;
  }

}