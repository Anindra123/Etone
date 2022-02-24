<?php 

require_once '../model/dataAcess.php';

$errors = array();
$cross_emote = "&#10060;";
$ok_emote = "&#9989;";
$name_pattern = "/^[a-zA-Z-' ]*$/";
$time_pattern = "/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/";

//remove hackable material
function sanitize_input($data){
	$data = htmlspecialchars($data);
	$data = stripslashes($data);
	$data = trim($data);
	return $data;
}


//validate email
function email_validation($mail){
	global $errors;
	$mail = sanitize_input($mail);
	if(empty($mail)){
		$errors["mail_err"] = "Email cannot be empty ".$GLOBALS['cross_emote'];
	}
	else if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
		$errors["mail_err"] = "Not a proper email ".$GLOBALS['cross_emote'];
	}

}

//validate passwords
function password_validation($pass,$key="pass_err"){
	global $errors;
	$pass = sanitize_input($pass);
	if(empty($pass)){
		$errors[$key] = "Password cannot be empty ".$GLOBALS['cross_emote'];
	}
	else if(strlen($pass) > 8){
		$errors[$key] = "Password can be maximum 8 characters long ".$GLOBALS['cross_emote'];
	}

}

//validate confirm password and whether the two password match
function confirm_pass_validation($cpass,$pass){
	global $errors;
	$cpass = sanitize_input($cpass);
	if(empty($cpass)){
		$errors["cpass_err"] = "Confirm Password Feild cannot be empty ".$GLOBALS['cross_emote'];
	}
	else if(strlen($pass) > 8){
		$errors["cpass_err"] = "Confirm Password Feild can be maximum 8 characters long ".$GLOBALS['cross_emote'];
	}
	else if($cpass !== $pass){
		$errors["cpass_err"] = "Password does not match ".$GLOBALS['cross_emote'];
	}

}

//validate name
function name_validation($fname,$lname,$mname){
	global $name_pattern,$errors;
	$fname = sanitize_input($fname);
	$lname = sanitize_input($lname);
	$mname = sanitize_input($mname);
	if(empty($fname)){
		$errors["fname_err"] = "First name cannot be empty ".$GLOBALS['cross_emote'];
	}
	else if(!preg_match($name_pattern,$fname)){
		$errors["fname_err"] = "Not a valid first name ".$GLOBALS['cross_emote'];
	}

	if(empty($lname)){
		$errors["lname_err"] = "Last name cannot be empty ".$GLOBALS['cross_emote'];
	}else if(!preg_match($name_pattern,$lname)){
		$errors["lname_err"] = "Not a valid last name ".$GLOBALS['cross_emote'];
	}

	if(!empty($mname) && !preg_match($name_pattern,$mname)){
		$errors["mname_err"] = "Not a valid middle name ".$GLOBALS['cross_emote'];
	}

}
//validate username
function username_validation($uname){
	global $errors;
	$uname = sanitize_input($uname);
	if(empty($uname)){
		$errors["uname_err"] = "User name cannot be empty ".$GLOBALS['cross_emote'];
	}else if(strlen($uname) > 5){
		$errors["uname_err"] = "Username can be maximum 5 characters ".$GLOBALS['cross_emote'];
	}
}

//validation for single empty text feilds
function required_check($text,$key,$msg){
	global $errors;
	$text = sanitize_input($text);
	if(empty($text)){
		$errors[$key] = $msg.$GLOBALS['cross_emote'];
	}
}
function empty_check($text,$key,$msg){
	global $errors;
	if(!isset($text)){
		$errors[$key] = $msg.$GLOBALS['cross_emote'];
	}
}
//validation for single text fields 
function valid_name_check($text,$key,$msg){
	global $errors,$name_pattern;
	$text = sanitize_input($text);
	if(!empty($text) && !preg_match($name_pattern,$text)){
		$errors[$key] = $msg.$GLOBALS['cross_emote'];
	}
}

function get_errors(){
	return $GLOBALS['errors'];
}

function get_sucess($msg){
	return $msg.$GLOBALS['ok_emote'];
}
function get_failure($msg){
	return $msg.$GLOBALS['cross_emote'];
}

function login_validation($email,$pass){
	global $cross_emote,$errors;
	$email = sanitize_input($email);
	$pass = sanitize_input($pass);
	$out = validate_login($email,$pass);
	if($out === []){
		$errors['mail_err'] = "Invalid mail or user doesn't exist ".$cross_emote;
		$errors['pass_err'] = "Invalid password or user doesn't exist ".$cross_emote;

	}
	else{
		return $out;
	}
}
function check_duplicate($uname,$pass,$mail){
	global $cross_emote,$errors;
	$uname = sanitize_input($uname);
	$mail = sanitize_input($mail);
	$pass = sanitize_input($pass);
	if(validate_registration($uname,$pass,$mail) === true){
		$errors['uname_err'] = "Account with same username or email or password already exists ".$cross_emote;
		$errors['mail_err'] = "Account with same username or email or password already exists ".$cross_emote;
		$errors['pass_err'] = "Account with same username or email or password already exists ".$cross_emote;
	}
}

function check_validPass($pass,$id){
	global $errors,$cross_emote;
	if(!valid_pass($pass,$id)){
		$errors['pass_err'] = "Given password doesn't match ".$cross_emote;
	}
}

function resetpass_validation($uname,$email){
	global $errors,$cross_emote;
	$out = passwordReset_validation($uname,$email);
	if($out < 0){
		$errors['uname_err'] = "Invalid username or account doesnt't exist ".$cross_emote;
		$errors['mail_err'] = "Invalid email or account doesnt't exist ".$cross_emote;
	}else{
		return $out;
	}
}	

function validate_time($stime,$etime){
	global $errors,$cross_emote;
	if(!empty($stime) && !empty($etime)){
		if(strtotime($stime) >= strtotime($etime)){
			$errors['stime_err'] = "Start time is greater or equal to end time ".$cross_emote;
			$errors['etime_err'] = "Start time is greater or equal to end time ".$cross_emote;
		}
	}
}