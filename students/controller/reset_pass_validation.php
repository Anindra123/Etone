<?php 
session_start();
require_once 'includes/validations.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/students.json");
$pass = $cpass = $u_id = "";
$errors = [];
$validated = false;


if($_SERVER['REQUEST_METHOD'] === "POST"){
	$pass = sanitize_input($_POST['pass']);
	$cpass = sanitize_input($_POST['cpass']);

	password_validation($pass);
	confirm_pass_validation($cpass,$pass);
	$errors = get_errors();
	$validated = true;

}

if(count($errors) === 0 && !isset($_SESSION['m_errors']) && $validated === true){
	$u_id = $_SESSION['u_id'] ?? '';
	
	if(isset($_SESSION['count']) && $_SESSION['count'] >=1)
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
	$result = update_password($u_id,$data);
	if($result !== null){
		if(isset($_SESSION['p_data']) && 
			isset($_SESSION['p_errors'])

		)
		{
			unset($_SESSION['p_data']);
			unset($_SESSION['p_errors']);

		}
		$result->close();
		$conn->close();
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
	if($_SESSION['count'] == 0){
		unset($_SESSION['count']);
	}
	$_SESSION['p_data'] = $data;
	$_SESSION['p_errors'] = $errors;
	header('Location: ../view/reset_pass.php');
	exit();
}

