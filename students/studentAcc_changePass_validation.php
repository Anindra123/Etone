<?php
session_start();
require_once 'validations.php';
require_once 'dataAcess.php';
$pass = $cpass = $npass = "";
$errors = [];
$validated = false;
$id = $_SESSION['id'] ?? '';



//perform the required validation and checking whether request method is post
if($_SERVER['REQUEST_METHOD'] === "POST"){
	global $pass,$npass,
	$cpass,$errors,$id;
	$pass = $_POST['pass'];
	$npass = $_POST['npass'];
	$cpass = $_POST['cpass'];
	
	password_validation($pass);
	
	$errors = get_errors();
	if(count($errors) === 0){
		check_validPass($pass,$id);
		$errors = get_errors();
		if(count($errors) === 0){
			password_validation($npass,"npass_err");
			confirm_pass_validation($cpass,$npass);
			$errors = get_errors();
		}
	}
	
	$validated = true;
}

// if all validation done and no errors found then save
// the data in json file
if(count($errors) === 0 && $validated === true){
	global $npass,
	$cpass,$id;
	$data = array(
		'pass' => $npass
	);
	
	update_password($data,$id);
	$_SESSION['success'] = get_sucess("Password changed sucessfully");
	if(isset($_SESSION['p_errors']) && isset($_SESSION['p_data'])){
		unset($_SESSION['p_errors']);
		unset($_SESSION['p_data']);
	}
	header("Location: student_changePass.php");
	exit();
}
else{
	global $pass,$npass,
	$cpass,$errors;
	$data = array(
		'npass' => $npass,
		'pass' => $pass,
		'cpass' => $cpass
	);
	$_SESSION['p_errors'] = $errors;
	$_SESSION['p_data'] = $data;
	header("Location: student_changePass.php");
	exit();
}