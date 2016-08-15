<?php

class Sauna extends BaseModel{

	public $id, $address, $price;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Sauna');

		$query->execute();

		$rows = $query->fetchAll();
		$saunas = array();

		foreach($rows as $row){
			$saunas[] = new Sauna(array(
				'id' => $row['id'],
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
				'address' => $row['address'],
				'price'=> $row['price']
				));

			return $sauna;
		}
		return null;
	}
	

}