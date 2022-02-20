<?php 
	session_start();
	require_once 'validations.php';
	$uname = $mail = $u_id = "";
	$errors = [];
	$validated = false;
	

	if($_SERVER['REQUEST_METHOD'] === "POST"){
		global $uname,$mail,$errors,$validated;
		$uname = $_POST['uname'];
		$mail = $_POST['mail'];

		email_validation($mail);
		username_validation($uname);
		$errors = get_errors();
		if(count($errors) === 0){
			resetpass_validation($uname,$mail);
			$errors = get_errors();
		}
		$validated = true;
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
		header('Location: reset_pass.php'); 
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
		header('Location: forgot_pass.php');
		exit();
	}

