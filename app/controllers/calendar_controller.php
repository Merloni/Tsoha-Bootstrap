<?php


class CalendarController extends BaseController{


	public static function calendar(){
		$dates = array();
		$year = date('Y');
		$month = date('M');

		for($i = 1; $i < date('t')+1; $i++){
			$helper = date('d-m-Y');

			if($i <= 9){
				$dates[] = 0 . "" . $i . substr($helper, 2);
			}else{
				$dates[] = $i . substr($helper, 2);
			}		
		} 	
  		View::make('calendar.html', array('dates' => $dates, 'year' => $year, 'month' => $month));
  	}
  	public static function getnextmonth(){

  	}
  	public static function getpreviousmonth(){
  	
  	}


	
}