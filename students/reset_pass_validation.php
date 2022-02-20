<?php 
session_start();
require_once 'validations.php';
require_once 'DataAcess.php';
$pass = $cpass = $u_id = "";
$errors = [];
$validated = false;


if($_SERVER['REQUEST_METHOD'] === "POST"){
	global $pass,$cpass,$errors,$validated;
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];

	password_validation($pass);
	confirm_pass_validation($cpass,$pass);
	$errors = get_errors();
	$validated = true;

}

if(count($errors) === 0 && $validated === true){
	global $pass,$cpass,$u_id;
	$u_id = $_SESSION['u_id'] ?? '';
		//print_r($_SESSION['u_id']);
	$_SESSION['success'] = get_sucess("Password reseted sucessfully ");
	if(isset($_COOKIE['count']) && $_COOKIE['count'] >= 1)
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
		header('Location: reset_pass.php');
		exit();
	}
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
	header('Location: reset_pass.php');
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
	header('Location: reset_pass.php');
	exit();
}

