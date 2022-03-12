<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/scheduleWeek.json");

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
if(count($errors) === 0 && $validated === true){
	$day = date('w');
	$sdate = date('m-d-Y',strtotime('-'.$day.' days'));
	$edate = date('m-d-Y',strtotime('+'.(6-$day).' days'));
	// $sdate = date('m-d-Y',strtotime('last sunday'));
	// $edate = date('m-d-Y',strtotime('this saturday'));
	// var_dump($sdate);
	// var_dump($edate);
	// exit();
	if($_SESSION['page_name'] === 'Update Schedule Week Page'){
		$swdata = [
			'wname' => $wname
		];
		$sw_id = $_SESSION['sw_id'];
		updateWeeklyScheduleData($uid,$sw_id,$swdata,get_fileName());
		$_SESSION['success'] = get_sucess("Schedule updated succesfully ");
		$_SESSION['swu_data'] = $swdata;
	}
	else{
		$swdata = [
			'id' => Null,
			'wname' => $wname,
			'sdate' => $sdate,
			'edate' => $edate,
			'uid' => $uid
		];
		setJsonData($swdata,get_fileName());
		$_SESSION['success'] = get_sucess("Schedule created succesfully ");
		if(isset($_SESSION['sw_errors']) && isset($_SESSION['sw_data'])){
			unset($_SESSION['sw_errors']);
			unset($_SESSION['sw_data']);
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
