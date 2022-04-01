<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/scheduleClass.json");
$cname = $rname = $stime = $etime = $uid = $pid = '';
$weekday = [];
$uid = $_SESSION['id'];
$pid = $_SESSION['sw_id'];
$sc_id = $_SESSION['sc_id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$cname = sanitize_input($_POST['cname']);
	$rname = sanitize_input($_POST['rname']);
	$stime = sanitize_input($_POST['stime']);
	$etime = sanitize_input($_POST['etime']);
	$weekday = $_POST['weekday'];
	required_check($cname,'cname_err','Class name cannot be empty ');
	valid_name_check($cname,'cname_err','Not a proper class name ');
	if(!empty($rname)){
		valid_name_check($rname,'rname_err','Not a proper remainder');
	}
	required_check($stime,"stime_err","Please select a start time");
	required_check($etime,"etime_err","Please select an end time");

	validate_time($stime,$etime);
	if(count($weekday) === 0){
		setErrorMsg('weekday_err','Please select a week day');
	}
	$errors = get_errors();
	$validated = true;
}
else{
	$_SESSION['m_errors'] = get_failure("Cannot process get request ");
	header(getRouteUrl());
	exit();
}
if(count($errors) === 0 && $validated === true){
	if($_SESSION['page_name'] === 'Update Class Schedule Page'){
		$scdata = [
			'cname' => $cname,
			'rname' => $rname,
			'stime' => $stime,
			'etime' => $etime,
 			'weekday' => $weekday
 		];
		updateClassScheduleData($uid,$pid,$sc_id,$scdata,get_fileName());
		$_SESSION['success'] = get_sucess("Schedule updated succesfully ");
		$_SESSION['scu_data'] = $swdata;
	}
	else{
		$scdata = [
			'cname' => $cname,
			'rname' => $rname,
			'stime' => $stime,
			'etime' => $etime,
 			'weekday' => $weekday,
 			'uid' => $uid,
 			'pid' => $pid
 		];
		setJsonData($scdata,get_fileName());
		$_SESSION['success'] = get_sucess("Schedule created succesfully ");
		if(isset($_SESSION['sc_errors']) && isset($_SESSION['sc_data'])){
			unset($_SESSION['sc_errors']);
			unset($_SESSION['sc_data']);
		}
	}
	header(getRouteUrl());
	exit();
}
else{
	$scdata = [
			'cname' => $cname,
			'rname' => $rname,
			'stime' => $stime,
			'etime' => $etime,
 			'weekday' => $weekday
 		];
	$_SESSION['sc_errors'] = $errors;
	if($_SESSION['page_name'] === 'Update Class Schedule Page'){
		$_SESSION['scu_date'] = $scdata;
	}
	else{
		$_SESSION['sc_data'] = $scdata;
	}
	header(getRouteUrl());
	exit();
}
