<?php 
	session_start();
	require_once 'includes/validations.php';
	$otpVal = "";
	$errors = [];
	$validated = false;
	if($_SERVER['REQUEST_METHOD'] === "POST"){
		$otpVal = sanitize_input($_POST['otp']);
		required_check($otpVal,"otp_err","Empty value given ");
		$errors = get_errors();
		if(!empty($otpVal)){
			if(isset($_COOKIE["auth_token"])){
				$expected = $_COOKIE["auth_token"];
				$hashVal = hash('sha256', $otpVal);
				if(!hash_equals($expected,$hashVal)){
					setErrorMsg("otp_err","OTP given doesn't match with generated otp");
				}
			}
			else{
				setErrorMsg("otp_err","OTP expired please generate a new one");
				if(isset($_SESSION['otp'])){
					unset($_SESSION['otp']);
				}
				if(isset($_SESSION['expire_time'])){
					unset($_SESSION['expire_time']);
				}
			}
			$errors = get_errors();
		}

		$validated = true;
	}


	if(count($errors) === 0 && !isset($_SESSION['m_errors']) && $validated === true){
		header('Location: ../view/reset_pass.php');
		exit();
	}
	else{
		$data['otp_data'] = $otpVal;
		$_SESSION['o_data'] = $data;
		$_SESSION['o_error'] = $errors;
		header('Location: ../view/authorizeUser.php');
		exit();

	}