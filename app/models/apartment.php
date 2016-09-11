<?php

class Apartment extends BaseModel{

	public $id, $loginname, $surname, $password;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_password', 'validate_surname', 'validate_loginname');
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
	public function save(){

    	$query = DB::connection()->prepare('INSERT INTO Apartment (loginname, surname, password) VALUES (:loginname, :surname, :password) RETURNING id');

    	$query->execute(array('loginname' => $this->loginname, 'surname' => $this->surname, 'password' => $this->password));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
	public static function authenticate($loginname, $password){
		$query = DB::connection()->prepare('SELECT * FROM Apartment WHERE loginname = :loginname AND password = :password LIMIT 1');
		$query->execute(array('loginname' => $loginname, 'password' => $password));

		$row = $query->fetch();

		if($row){
			$apartment = new Apartment(array(
				'id' => $row['id'],
				'loginname' => $row['loginname'],
				'surname' => $row['surname'],
				'password' => $row['password']));

			return $apartment;

		}else{
			return null;
		}
	}
	public function validate_password(){
		$errors = array();

		if($this->password == '' || $this->password == null){
			$errors[] = 'Salasana ei saa olla tyhjä';
		}else if (strlen($this->password) < 5){
			$errors[] = 'Salasanan tulee olla pitempi kuin neljä merkkiä';
		}
		return $errors;
	}
	public function validate_surname(){
		$errors = array();

		if($this->surname == '' || $this->surname ==null){
			$errors[] = 'Sukunimi ei saa olla tyhjä';
		}
		return $errors;
	}
	public function validate_loginname(){
		$errors = array();

		if($this->loginname == '' || $this->loginname == null){
			$errors[] = 'Käyttäjätunnus ei saa olla tyhjä';
		}
		return $errors;
	} 
	

}