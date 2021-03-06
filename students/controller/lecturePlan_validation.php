<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$sname = $topics =  "";
$uid= $_SESSION['id'];
$errors = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$sname = sanitize_input($_POST['sname']);
	$topics = sanitize_input($_POST['topics']);
	required_check($sname,"sname_err","Task title cannot be empty");
	valid_name_check($sname,"sname_err","Not a proper task title");
	$topics = sanitize_input($topics);
	$errors = get_errors();
	$validated = true;
}
else{
	$_SESSION['m_errors'] = get_failure("Cannot process get request ");
	header('Location: ../view/student_lecturePlanner.php');
	exit();
}
if(count($errors) === 0 && $validated === true){
	if($_SESSION['page_name'] === 'Update Lecture Plan Page'){
		$lpdata = [
			'sname' => $sname,
			'topics' => $topics
		];
		$lpid = $_SESSION['lp_id'];
		$result = updateLecturePlanData($uid,$lpid,$lpdata);
		if($result !== null){
			$_SESSION['success'] = get_sucess("Lecture plan updated succesfully ");
			$_SESSION['lpu_data'] = $lpdata;
			$result->close();
			$conn->close();
		}
	}
	else{
		$lpdata = [
			'sname' => $sname,
			'topics' => $topics,
			'uid' => $uid
		];
		
		$result = setLecturePlanData($lpdata);
		if($result !== null){
			$_SESSION['success'] = get_sucess("Lecture plan created succesfully ");
			if(isset($_SESSION['lp_errors']) && isset($_SESSION['lp_data'])){
				unset($_SESSION['lp_errors']);
				unset($_SESSION['lp_data']);
			}
			$result->close();
			$conn->close();
		}
	}
	
	header(getRouteUrl());
	exit(); 
}
else{
	$_SESSION['lp_errors'] = $errors;
	$data = [
		'sname' => $sname,
		'topics' => $topics
	];
	if($_SESSION['page_name'] === 'Update Lecture Plan Page'){
		$_SESSION['lpu_data'] = $data;
	}	
	else{
		$_SESSION['lp_data'] = $data;
	}
	header(getRouteUrl());
	exit(); 
}
