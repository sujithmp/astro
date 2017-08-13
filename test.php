<?php

function test(){
	$defaultYear = $currentYear = new Date('Y');
	/* get all years in the database which is tobe shownin the select dropdown*/
	$yrs = getAllyears();
	$years =array();
	if($yrs!==array()){
		foreach($yrs as $y){
			array_push($years, $y);
		}
		if(in_array($defaultYear, $years)){
			$selectedYear = $defaultYear;
			/*find the sales total*/	
		}else{
			array_push($years, $defaultYear);
			$selectedYear = $defaultYear;
			/*find the default sales total*/	
		}
		if(isset($_POST['year']) && !in_array($_POST['year'], $years)){
			array_push($years, $_POST['year']);
			/*find the default sales total*/
		}


	}else{
		array_push($years, $defaultYear);
		array_push($years, $defaultYear+1);
		$selectedYear = $defaultYear;
		if(isset($_POST['year']) && !in_array($_POST['year'], $years)){
			array_push($years, $_POST['year']);
		}
		/*find the default sales total*/
	}
	
}
?>