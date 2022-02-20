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
		
		
	}

	if(count($errors) === 0 && $validated === true){
		global $pass,$cpass,$u_id;
		$u_id = $_SESSION['u_id'] ?? '';
		if($u_id === ''){
			$_SESSION['r_error'] = get_failure("Password 
				already reseted ");
			header('Location: reset_pass.php');
			exit();
		}
		update_password($pass,$u_id);
		if(isset($_SESSION['p_data']) && 
			isset($_SESSION['p_errors'])&&
			isset($_SESSION['u_id'])
			)
		{
			unset($_SESSION['p_data']);
			unset($_SESSION['p_errors']);
			unset($_SESSION['u_id']);
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

