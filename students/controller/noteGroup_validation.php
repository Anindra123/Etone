<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/noteGroup.json");
$gname = $con_per = "";
$g_users = $_SESSION['g_users'];
$errors = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$gname = sanitize_input($_POST['gname']);
	$con_per = sanitize_input($_POST['con_per']);
	required_check($gname,"gname_err","Group name cannot be empty ");
	required_check($con_per,"con_per_err","Please select a content permission option");
	valid_name_check($gname,"gname_err","Not a proper group name");
	$errors = get_errors();
	$validated = true;
}
else{
	$_SESSION['m_errors'] = get_failure("Cannot process get request ");
	header('Location: ../view/student_lecturePlanner.php');
	exit();
}
if(count($errors) === 0 && $validated === true){
	if($_SESSION['page_name'] === 'Update Note Group Page'){
		$ng_data = $_SESSION['ngu_data'];
		$ng_data['gname'] = $gname;
		$ng_data['con_per'] = $con_per;
		$ng_data['note_viewers'] = $g_users;
		$id = $_SESSION['g_id'];
		updateNoteGroupData($id,$ng_data,get_fileName());
		$_SESSION['success'] = get_sucess('Group info updated succesfully ');
	}	
	else{
		$ng_data = [
			'id' => Null,
			'gname' => $gname,
			'note_viewers' => $g_users,
			'con_per' => $con_per,
			'shared_notes' => Null,
		];
		if(isset($_SESSION['g_users'])){
			unset($_SESSION['g_users']);
		}
		setJsonData($ng_data,get_fileName());
		header('Location: ../view/student_noteGroup.php');
		exit();
	}
	header(getRouteUrl());
	exit();
}
else{
	$_SESSION['ng_errors'] = $errors;
	$ng_data = [
		'gname' => $gname,
		'con_per' => $con_per,
		'note_viewers' => $g_users
	];

	$_SESSION['ng_data'] = $ng_data;
	if($_SESSION['page_name'] === 'Update Note Group Page'){
		unset($_SESSION['ng_data']);
		$ng_data = $_SESSION['ngu_data'];
		$ng_data['gname'] = $gname;
		$ng_data['con_per'] = $con_per;
		$ng_data['note_viewers'] = $g_users;
		$_SESSION['ngu_data'] = $ng_data;
	}
	header(getRouteUrl());
	exit();
}