<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$title = $stime = $etime = $status = $date =  "";
$uid= $_SESSION['id'];
$errors = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$title = $_POST['tname'];
	$stime = $_POST['stime'];
	$etime = $_POST['etime'];
	required_check($title,"tname_err","Task title cannot be empty");
	valid_name_check($title,"tname_err","Not a proper task title");
	required_check($stime,"stime_err","Please select a start time");
	required_check($etime,"etime_err","Please select an end time");

	validate_time($stime,$etime);
	$errors = get_errors();
	$validated = true;
}

if(count($errors) === 0 && $validated === true){
	$data = [
		'tname' => $title,
		'stime' => $stime,
		'etime' => $etime,
		'status'=> $status,
		'date' => $date,
		'sid' => $uid
	];
	if($_SESSION['page_name'] === 'Update Task Page'){
		$udata = [
			'tname' => $title,
			'stime' => $stime,
			'etime' => $etime
		];
		$tid = $_SESSION['t_id'];
		$result = updateTaskData($uid,$tid,$udata);
		if($result !== null){
			$_SESSION['success'] = get_sucess("Task updated succesfully ");
			$_SESSION['tu_data'] = $udata;
			$result->close();
			$conn->close();
		}
	}
	else{
		$result = setTaskData($data);
		if($result !== null){
			$_SESSION['success'] = get_sucess("Task created succesfully ");
			if(isset($_SESSION['t_errors']) && isset($_SESSION['t_data'])){
				unset($_SESSION['t_errors']);
				unset($_SESSION['t_data']);
			}
			$result->close();
			$conn->close();
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
