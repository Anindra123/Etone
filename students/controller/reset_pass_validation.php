<?php 
session_start();
require_once 'validations.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/students.json");
$pass = $cpass = $u_id = "";
$errors = [];
$validated = false;


if($_SERVER['REQUEST_METHOD'] === "POST"){
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];

	password_validation($pass);
	confirm_pass_validation($cpass,$pass);
	$errors = get_errors();
	$validated = true;

}

if(count($errors) === 0 && $validated === true){
	$u_id = $_SESSION['u_id'] ?? '';
	
	if(isset($_SESSION['count']) && $_SESSION['count'] >= 1)
	{	
		if(isset($_SESSION['p_data']) && 
			isset($_SESSION['p_errors'])
		)
		{
			unset($_SESSION['p_data']);
			unset($_SESSION['p_errors']);
			
		}
		$_SESSION['r_errors'] = get_failure("Password 
			already reseted ");
		header('Location: ../view/reset_pass.php');
		exit();
	}
	$_SESSION['success'] = get_sucess("Password reseted sucessfully ");
	$data = array(
		'pass' => $pass
	);
	update_password($data,$u_id);
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
	global $pass,$cpass,$errors;
	$data = array(
		'pass' => $pass,
		'cpass' => $cpass
	);
	$_SESSION['p_data'] = $data;
	$_SESSION['p_errors'] = $errors;
	header('Location: ../view/reset_pass.php');
	exit();
}

