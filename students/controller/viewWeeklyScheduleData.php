<?php
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$uid = $_SESSION['id'];

if($_SESSION['page_name'] === 'Update Schedule Week Page'){
	$sw_id = $_SESSION['sw_id'];
	$scid = $_SESSION['sc_id'];
	
	$result = getWeeklyScheduleData($uid,$sw_id);
	if($result !== null){
		$dataResult = $result->get_result();
		if($dataResult->num_rows >= 1){
			$_SESSION['swu_data'] = $dataResult->fetch_assoc();
		}
		$result->close();
		$conn->close();
	}

}
else if($_SESSION['page_name'] === 'Update Class Schedule Page'){
	$sw_id = $_SESSION['sw_id'];
	$scid = $_SESSION['sc_id'];

	$result = getClassSchedule($uid,$sw_id,$scid);
	if($result !== null){
		$dataResult = $result->get_result();
		if($dataResult->num_rows >= 1){
			$_SESSION['scu_data'] = $dataResult->fetch_assoc();
		}
		else{
			$_SESSION['scu_data'] = [];
		}
		$result->close();
		$conn->close();
	}
}
else{
	$sw_id =$sc_id = "";
	$result = getAllWeeklyScheduleData($uid);
	$_SESSION['sc_data'] = [];
	if($result !== null){
		$dataResult = $result->get_result();
		$out = [];
		if($dataResult->num_rows >= 1){
			$out[] = $dataResult->fetch_assoc();
			$_SESSION['sw_data'] = $out;
			$sw_id = $out[0]['id'];
		}else{
			$_SESSION['sw_data'] = [];
		}
		$result->close();
		$conn->close();
	}
	$cresult = getAllClassSchedule($uid,$sw_id);

	if($cresult !== null){
		$dataResult = $cresult->get_result();
		$out = [];
		
		$weekday = [];
		if($dataResult->num_rows >= 1){
			while($data = $dataResult->fetch_assoc()){
				$out[] = $data;
				$sc_id = $data['id'];
				$wresult = getAllWeekDays($sc_id);
				
				if($wresult !== null){
					$wdataResult = $wresult->get_result();

					if($wdataResult->num_rows >= 1){
						$week = [];
						while ($data = $wdataResult->fetch_assoc()) {
							$week[$data['id']] = $data['wname'];

						}
						$weekday[$sc_id] = $week;
						$_SESSION['week_data'] = $weekday;
					}
					else{
						$_SESSION['week_data'] = [];
					}
					
					$wresult->close();
				}
			}
			$_SESSION['sc_data'] = $out;
		}
		else{
			$_SESSION['sc_data'] = [];
		}

		$cresult->close();
		$conn->close();
	}
}

header(getRouteUrl());
exit();