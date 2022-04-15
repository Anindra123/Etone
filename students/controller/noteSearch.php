<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$query = $uid = $pid = "";
$uid = $_SESSION['id'];
$pid = $_SESSION['pid'];
$errors = [];
$search = [];
$err = false;
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$query = sanitize_input($_GET['n_name']);
	required_check($query,'search_err','Empty search query ');
	if(!empty($query)){
		
		$s_data = searchNoteData($uid,$pid,$query);
		if($s_data !== null){
			$s_data = $s_data->get_result();
			if($s_data->num_rows === 1){
				$search[0] = $s_data->fetch_assoc();
			}
			else{
				setErrorMsg('search_err','Data not found or invalid query ');
			}	
		}
		
	}
	$errors = get_errors();
	$validated = true;
}


if(count($errors) === 0 && !isset($_SESSION['m_errors']) && $validated === true){
	$_SESSION['ln_data'] = $search;
	header(getRouteUrl());
	exit();
}

else{
	$_SESSION['ln_errors'] = $errors;
	header(getRouteUrl());
	exit();
}