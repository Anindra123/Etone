<?php 
session_start();
require_once 'validations.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/students.json");
$uname = $mail = $u_id = "";
$errors = [];
$validated = false;


if($_SERVER['REQUEST_METHOD'] === "POST"){
	global $uname,$mail,$errors,$validated;
	$uname = sanitize_input($_POST['uname']);
	$mail = sanitize_input($_POST['mail']);

	email_validation($mail);
	username_validation($uname);
	$errors = get_errors();
	if(count($errors) === 0){
		resetpass_validation($uname,$mail);
		$errors = get_errors();
	}
	$validated = true;
}
else{
	$_SESSION['m_errors'] = get_failure("Cannot process get request ");
	header('Location: ../view/forgot_pass.php');
	exit();
}
if(count($errors) === 0 && $validated === true){
	global $uname,$mail,$u_id;
	$u_id = resetpass_validation($uname,$mail);
	$_SESSION['u_id'] = $u_id;
	if(isset($_SESSION['p_data']) && 
		isset($_SESSION['p_errors'])
	)
	{
		unset($_SESSION['p_data']);
		unset($_SESSION['p_errors']);
	}
	header('Location: ../view/reset_pass.php'); 
	exit();
}
else{
	global $uname,$mail,$errors;
	$data = array(
		'uname' => $uname,
		'mail' => $mail
	);
	$_SESSION['p_data'] = $data;
	$_SESSION['p_errors'] = $errors;
	header('Location: ../view/forgot_pass.php');
	exit();
}

