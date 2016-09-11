<?php

class Sauna extends BaseModel{

	public $id, $name, $address, $price;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_address', 'validate_price');
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Sauna');

		$query->execute();

		$rows = $query->fetchAll();
		$saunas = array();

		foreach($rows as $row){
			$saunas[] = new Sauna(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'address' => $row['address'],
				'price' => $row['price']
				));
		}
		return $saunas;
	}
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Sauna WHERE id = :id LIMIT 1');

		$query->execute(array('id'=> $id));
		
		$row = $query->fetch();

		if($row){
			$sauna = new Sauna(array(
				'id'=> $row['id'],
				'name' => $row['name'],
				'address' => $row['address'],
				'price'=> $row['price']
				));

			return $sauna;
		}
		return null;
	}
	public function save(){

    	$query = DB::connection()->prepare('INSERT INTO Sauna (name, address, price) VALUES (:name, :address, :price) RETURNING id');

    	$query->execute(array('name' => $this->name, 'address' => $this->address, 'price' => $this->price));

    	$row = $query->fetch();
    
    	$this->id = $row['id'];

  	}
  	public function update(){

  		$query = DB::connection()->prepare('UPDATE Sauna SET name = :name, address = :address,
  			price = :price WHERE id = :id RETURNING id');

      $query->execute(array('id' => $this->id, 'name' => $this->name, 'address' => $this->address, 'price' => $this->price));

      $row = $query->fetch();
    
      $this->id = $row['id'];

  	}
  	public function destroy(){

  		$query = DB::connection()->prepare('DELETE FROM Sauna WHERE id = :id');

  		$query->execute(array('id' => $this->id));


  	}
  	public function validate_name(){
  		$errors = array();

  		if($this->name == '' || $this->name == null){
  			$errors[] = 'Nimi ei saa olla tyhjä';
  		}
  		return $errors;
  	}
  	public function validate_address(){
  		$errors = array();

  		if($this->address == '' || $this->address == null){
  			$errors[] = 'Osoite ei saa olla tyhjä';
  		}
  		return $errors;
  	}
  	public function validate_price(){
  		$errors = array();

  		if($this->price == '' || $this->price == null){
  			$errors[] = 'Hinta ei saa olla tyhjä, jos hinta on 0€ se täytyy merkata';
  		}

  		return $errors;
  	}
	

}