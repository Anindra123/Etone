<?php 
session_start();
require_once 'validations.php';
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/lectureNoteData.json");
$query = $uid = $pid = "";
$uid = $_SESSION['id'];
$pid = $_SESSION['pid'];
$errors = [];
$s_data = [];
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$query = sanitize_input($_GET['n_name']);
	required_check($query,'search_err','Empty search query ');
	if(!empty($query)){
		$s_data = searchJsonData($uid,'tname',$query,get_fileName(),$pid);
		if(count($s_data) === 0){
			setErrorMsg('search_err','Data not found or invalid query ');
		}
	}
	$errors = get_errors();
	$validated = true;
}


if(count($errors) === 0 && $validated === true){
	$data[] =(object)$s_data;
	$_SESSION['ln_data'] = $data;
	header(getRouteUrl());
	exit();
}
else{
	$_SESSION['ln_errors'] = $errors;
	header(getRouteUrl());
	exit();
}