<?php
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/scheduleWeek.json");
$uid = $_SESSION['id'];
$sw_id = $_SESSION['sw_id'];
$scid = $_SESSION['sc_id'];
if($_SESSION['page_name'] === 'Update Schedule Week Page'){
	// $_SESSION['swu_data']  = getSingleJsonData($uid,$sw_id,get_fileName());
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
	set_type("f","../model/scheduleClass.json");
	$_SESSION['scu_data']  = getSingleJsonData($uid,$scid,get_fileName(),$sw_id);
}
else{
	// $_SESSION['sw_data'] = getAllJsonData($uid,get_fileName());
	// set_type("f","../model/scheduleClass.json");
	// $sw_data = $_SESSION['sw_data'];
	// $sw_id = $sw_data[0]->id;
	// $_SESSION['sc_data'] = getAllJsonData($uid,get_fileName(),$sw_id);
	$result = getAllWeeklyScheduleData($uid);
	$_SESSION['sc_data'] = [];
	if($result !== null){
		$dataResult = $result->get_result();
		$out = [];
		if($dataResult->num_rows >= 1){
			$out[] = $dataResult->fetch_assoc();
			$_SESSION['sw_data'] = $out;
		}
		else{
			$_SESSION['sw_data'] = [];
		}
		$result->close();
		$conn->close();
	}

}

header(getRouteUrl());
exit();