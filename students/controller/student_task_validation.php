<?php 
session_start();
require_once 'validations.php';
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/student_taskData.json");
$title = $stime = $etime = $status = $date =  "";
$uid= $_SESSION['id'];
$errors = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$title = $_POST['tname'];
	$stime = $_POST['stime'];
	$etime = $_POST['etime'];
	$status = "To Do";
	$date = date("m-d-Y",time());
	required_check($title,"tname_err","Task title cannot be empty");
	valid_name_check($title,"tname_err","Not a proper task title");
	required_check($stime,"stime_err","Please select a start time");
	required_check($etime,"etime_err","Please select an end time");

	validate_time($stime,$etime);
	$errors = get_errors();
	$validated = true;
}

if(count($errors) === 0 && $validated === true){
	$stime = date('h:i A',strtotime($stime));
	$etime = date('h:i A',strtotime($etime));
	$data = [
		'id' => Null,
		'tname' => $title,
		'stime' => $stime,
		'etime' => $etime,
		'status'=> $status,
		'date' => $date,
		'uid' => $uid
	];
	if($_SESSION['page_name'] === 'Update Task Page'){
		$udata = [
			'tname' => $title,
			'stime' => $stime,
			'etime' => $etime
		];
		$tid = $_SESSION['t_id'];
		updateTaskData($uid,$tid,$udata,get_fileName());
		$_SESSION['success'] = get_sucess("Task updated succesfully ");
		$_SESSION['tu_data'] = $udata;
	}
	else{
		setJsonData($data,get_fileName());
		$_SESSION['success'] = get_sucess("Task created succesfully ");
		if(isset($_SESSION['t_errors']) && isset($_SESSION['t_data'])){
			unset($_SESSION['t_errors']);
			unset($_SESSION['t_data']);
		}
	}
	
	header(getRouteUrl());
	exit(); 
}
else{
	$_SESSION['t_errors'] = $errors;
	$data = [ 'tname' => $title,'stime' => $stime , 
	'etime' => $etime];
	if($_SESSION['page_name'] === 'Update Task Page'){
		$_SESSION['tu_data'] = $data;
	}	
	else{
		$_SESSION['t_data'] = $data;
	}
	header(getRouteUrl());
	exit(); 
}
