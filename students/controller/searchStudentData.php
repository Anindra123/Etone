<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/noteGroup.json");
$query = "";
$s_data =[];
$errors = [];
$g_users = [];
$data = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$query = sanitize_input($_GET['mail']);
	$g_users = $_SESSION['g_users'];
	email_validation($query,'mail_err','Empty mail given');
	for ($i=0; $i < count($g_users); $i++) { 
		$data = $g_users[$i];
		if($data['mail'] === $query){
			setErrorMsg('mail_err','User already in group');
		}
	}

	$errors = get_errors();
	if(count($errors) === 0){
		if(!empty($query)){
			if(userMemberOfGroup($query,get_fileName())){
				setErrorMsg('mail_err','User already part of another group');
			}
			set_type("f","../model/students.json");
			$s_data =(array) search_studentData($query,get_fileName());
			if(count($s_data) === 0){
				setErrorMsg('mail_err','User not found or invalid mail given ');
			}

		}
		$errors = get_errors();
	}
	$validated = true;
}
if(count($errors) === 0 && $validated === true){
	if(count($s_data) > 0){
		$data = $s_data;
		$data['role'] = 'v';
		$g_users[] = array('id' => $data['id'], 'name' => $data['uname'],'mail' => $data['mail'],'role' =>$data['role']);
		
		$_SESSION['g_users'] = $g_users;
		
		$_SESSION['success'] = get_sucess('Member added sucessfully ');
	}
}else{
	$_SESSION['ng_errors'] = $errors;

}

header(getRouteUrl());
exit();