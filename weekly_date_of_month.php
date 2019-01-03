<?php

/*
https://www.daniweb.com/programming/web-development/threads/367731/find-all-weeks-first-date-and-last-date
*/

function getWeeklyDatefMonth($month){
	
	$year = intval(date('Y')); //initialize current year
	$month = intval($month); //force month to single integer if '0x'
	$suff = array('st','nd','rd','th','th','th');  //week suffixes
	$end = date('t',mktime(0,0,0,$month,1,$year));  //last date day of month: 28 - 31
	$start = date('w',mktime(0,0,0,$month,1,$year)); //1st day of month: 0 - 6 (Sun - Sat)
	  //$last = 7 - $start;  //get last day date (Sat) of first week
	  $last = 8 - $start;  //get last day date (Sun) of first week
	$noweeks = ceil((($end - ($last + 1))/7) + 1); //total no. weeks in month
	  //$output = ""; //initialize string
	  $output = [];  //initialize array
	$monthlabel = str_pad($month, 2, '0', STR_PAD_LEFT);
	for($x=1;$x<$noweeks+1;$x++){
		if($x == 1){
			$startdate = "$year-$monthlabel-01";
			$day = $last - 6;
		}else{
			$day = $last + 1 + (($x-2)*7);
			$day = str_pad($day, 2, '0', STR_PAD_LEFT);
			$startdate = "$year-$monthlabel-$day";
		}
		if($x == $noweeks){
			$enddate = "$year-$monthlabel-$end";
		}else{
			$dayend = $day + 6;
			$dayend = str_pad($dayend, 2, '0', STR_PAD_LEFT);
			$enddate = "$year-$monthlabel-$dayend";
		}
	  //$output .= "{$x}{$suff[$x-1]} week -> Start date=$startdate End date=$enddate <br />";
	  $output["week{$x}"]["start_date"] = $startdate;
	  $output["week{$x}"]["end_date"] = $enddate;
	}
	return json_encode($output);
}

//echo getWeeklyDatefMonth($month= date('n'));
$weeks = getWeeklyDatefMonth( $month = intval(date('n', strtotime('+1 month'))) );
echo '<pre>';
	print_r( json_decode($weeks, TRUE) );
echo '</pre>';
?>
