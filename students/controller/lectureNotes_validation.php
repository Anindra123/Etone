<?php 
session_start();
require_once 'validations.php';
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/lectureNoteData.json");
$tname = $ltime = $ldate = $notes = $uid = $pid ="";
$uid= $_SESSION['id'];
$pid = $_SESSION['pid'];
$errors = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$tname = sanitize_input($_POST['tname']);
	$ltime = sanitize_input($_POST['ltime']);
	$ldate = sanitize_input($_POST['ldate']);
	$notes = sanitize_input($_POST['notes']);
	$ltime = date('h:i A',strtotime($ltime));
	required_check($tname,"tname_err","Note topic title cannot be empty ");
	valid_name_check($tname,"tname_err","Not a proper lecture topic name ");
	required_check($notes,'notes_err','Please enter a note ');
	valid_time_check($ltime,'ltime_err','Not a valid time ');
	valid_date_check($ldate,'ldate_err','Not a valid date ');
	$errors = get_errors();
	$validated = true;
}
else{
    $_SESSION['m_errors'] = get_failure("Cannot process get request ");
    header('Location: ../view/student_lectureNotes.php');
    exit();
}

if(count($errors) === 0 && $validated === true){
	if($_SESSION['page_name'] === 'Update Lecture Notes Page'){
		$lndata = [
			'tname' => $tname,
			'ltime' => $ltime,
			'ldate' => $ldate,
			'notes' => $notes
		];
		$lnid = $_SESSION['ln_id'];
		updateLectureNoteData($uid,$pid,$lnid,$lndata,get_fileName());
		$_SESSION['success'] = get_sucess("Lecture note updated succesfully ");
		$_SESSION['lnu_data'] = $lndata;
	}
	else{
		$lndata = [
			'id' => Null,
			'tname' => $tname,
			'ltime' => $ltime,
			'ldate' => $ldate,
			'notes' => $notes,
			'uid' => $uid,
			'pid' => $pid
		];
		setJsonData($lndata,get_fileName());
		$_SESSION['success'] = get_sucess("Lecture note created succesfully ");
		if(isset($_SESSION['ln_errors']) && isset($_SESSION['ln_data'])){
			unset($_SESSION['ln_errors']);
			unset($_SESSION['ln_data']);
		}
	}
	
	header(getRouteUrl());
	exit(); 
}
else{
	$_SESSION['ln_errors'] = $errors;
	$lndata = [
			'tname' => $tname,
			'ltime' => $ltime,
			'ldate' => $ldate,
			'notes' => $notes
		];
	if($_SESSION['page_name'] === 'Update Lecture Notes Page'){
		$_SESSION['lnu_data'] = $lndata;
	}	
	else{
		$_SESSION['ln_data'] = $lndata;
	}
	header(getRouteUrl());
	exit(); 
}