<?php

class Apartment extends BaseModel{

	public $id, $loginname, $surname, $password;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Apartment');

		$query->execute();

		$rows = $query->fetchAll();
		$apartments = array();

		foreach($rows as $row){
			$apartments[] = new Apartment(array(
				'id' => $row['id'],
				'loginname' => $row['loginname'],
				'surname' => $row['surname'],
				'password' => $row['password']
				));
		}
		return $apartments;
	}
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Apartment WHERE id = :id LIMIT 1');

		$query->execute(array('id'=> $id));
		
		$row = $query->fetch();

		if($row){
			$apartment = new Apartment(array(
				'id'=> $row['id'],
				'loginname' => $row['loginname'],
				'surname'=> $row['surname'],
				'password'=> $row['password']
				));

			return $apartment;
		}
		return null;
	}
	

}