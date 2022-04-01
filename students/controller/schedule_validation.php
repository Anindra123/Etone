<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/scheduleWeek.json");

$wname = $sdate = $edate = $uid = '';
$uid = $_SESSION['id'];
$errors = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$wname = sanitize_input($_POST['wname']);
	required_check($wname,'wname_err','Week name cannot be empty ');
	valid_name_check($wname,'wname_err','Not a proper week name ');
	$errors = get_errors();
	$validated = true;
}
else{
	$_SESSION['m_errors'] = get_failure("Cannot process get request ");
	header(getRouteUrl());
	exit();
}
if(count($errors) === 0 && !isset($_SESSION['m_errors']) && $validated === true){
	$day = date('w');
	$sdate = date('Y-m-d',strtotime('-'.$day.' days'));
	$edate = date('Y-m-d',strtotime('+'.(6-$day).' days'));

	if($_SESSION['page_name'] === 'Update Schedule Week Page'){
		$swdata = [
			'wname' => $wname
		];
		$sw_id = $_SESSION['sw_id'];
		$result = updateWeeklyScheduleData($uid,$sw_id,$swdata);
		if($result !== null){
			$_SESSION['success'] = get_sucess("Schedule updated succesfully ");
			$_SESSION['swu_data'] = $swdata;
			$result->close();
			$conn->close();
		}
	}
	else{
		$swdata = [
			'wname' => $wname,
			'sdate' => $sdate,
			'edate' => $edate,
			'uid' => $uid
		];
		$result = setWeeklyScheduleData($swdata);
		if($result !== null){
			$_SESSION['success'] = get_sucess("Schedule created succesfully ");
			if(isset($_SESSION['sw_errors']) && isset($_SESSION['sw_data'])){
				unset($_SESSION['sw_errors']);
				unset($_SESSION['sw_data']);
			}
			$result->close();
			$conn->close();
		}

		header('Location: ../view/student_scheduler.php');
		exit();
	}
	header(getRouteUrl());
	exit();
}
else{
	$swdata = [
		'wname' => $wname
	];
	$_SESSION['sw_errors'] = $errors;
	if($_SESSION['page_name'] === 'Update Schedule Week Page'){
		$_SESSION['swu_date'] = $swdata;
	}
	else{
		$_SESSION['sw_data'] = $swdata;
	}
	header(getRouteUrl());
	exit();
}
