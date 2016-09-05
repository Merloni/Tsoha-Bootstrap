<?php


class CalendarController extends BaseController{


	public static function calendar(){
		$dates = array();

		for($i = 1; $i < date('t')+1; $i++){
			$helper = date('d-m-Y');

			if($i <= 9){
				$dates[] = 0 . "" . $i . substr($helper, 2);
			}else{
				$dates[] = $i . substr($helper, 2);
			}
			
			
		} 

		
  		View::make('calendar.html', array('dates' => $dates));
  	}


	
}