<?php 
	//lay ngay tu dan int
	function get_date($time, $full_time = true){
		$fomat = '%Y-%m-%d';
		$date = "";
		if($full_time){
			//$fomat = $fomat.' - %H:%i:%s';
			$date = mdate($fomat, $time);
		}
		
		return $date;
	}