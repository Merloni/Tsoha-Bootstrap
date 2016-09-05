<?php


class CalendarController extends BaseController{


	public function thisMonth(){

		global $daystofinnish, $asd;

		$year = date('Y');
		$month = date('M');
		$firstday = date('01-M-Y');

		Kint::dump(translateToFinnish());

		
	}
	public function translateToFinnish($day){
		$daystofinnish = array("Mon" => "Maanantai", "Tue" => "Tiistai", "Wen" => "Keskiviikko", "Thu" => "Torstai", "Fri" => "Perjantai", "Sat" => "Lauantai", "Sun" => "Sunnuntai");
		
		return $daystofinnish;		

	}
	public static function calendar(){
		$days = array();
		for($i = 1; $i < date('t')+1; $i++){
			$days[] = $i;
		} 

  		View::make('calendar.html', array('days' => $days));
  	}


	
}