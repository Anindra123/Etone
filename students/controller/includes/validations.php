<?php 

require_once '../model/dbDataAcess.php';

$errors = array();
$cross_emote = "&#10060;";
$ok_emote = "&#9989;";
$name_pattern = "/^[a-zA-Z0-9-' ]*$/";
$time_pattern = "/^(0?[1-9]|1[0-2]):([0-5]\d)\s?((?:A|P)\.?M\.?)$/i";

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
		$errors["mail_err"] = "Email cannot be empty ";
	}
	else if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
		$errors["mail_err"] = "Not a proper email ";
	}

}


//validate passwords
function password_validation($pass,$key="pass_err"){
	global $errors;
	$pass = sanitize_input($pass);
	if(empty($pass)){
		$errors[$key] = "Password cannot be empty ";
	}
	else if(strlen($pass) < 6 || strlen($pass) > 10){
		$errors[$key] = "Password must be minimum 6 characters and maximum 10 characters ";
	}

}

//validate confirm password and whether the two password match
function confirm_pass_validation($cpass,$pass){
	global $errors;
	$cpass = sanitize_input($cpass);
	if(empty($cpass)){
		$errors["cpass_err"] = "Confirm Password Feild cannot be empty ";
	}
	else if(strlen($pass) < 6 || strlen($pass) > 10){
		$errors[$key] = "Password must be minimum 6 characters and maximum 10 characters ";
	}
	else if($cpass !== $pass){
		$errors["cpass_err"] = "Password does not match ";
	}

}

//validate name
function name_validation($fname,$lname,$mname){
	global $name_pattern,$errors;
	$fname = sanitize_input($fname);
	$lname = sanitize_input($lname);
	$mname = sanitize_input($mname);
	if(empty($fname)){
		$errors["fname_err"] = "First name cannot be empty ";
	}
	else if(!preg_match($name_pattern,$fname)){
		$errors["fname_err"] = "Not a valid first name ";
	}

	if(empty($lname)){
		$errors["lname_err"] = "Last name cannot be empty ";
	}else if(!preg_match($name_pattern,$lname)){
		$errors["lname_err"] = "Not a valid last name ";
	}

	if(!empty($mname) && !preg_match($name_pattern,$mname)){
		$errors["mname_err"] = "Not a valid middle name ";
	}

}
//validate username
function username_validation($uname){
	global $errors;
	$uname = sanitize_input($uname);
	if(empty($uname)){
		$errors["uname_err"] = "User name cannot be empty ";
	}else if(strlen($uname) > 5){
		$errors["uname_err"] = "Username can be maximum 5 characters ";
	}
}

//validation for single empty text feilds
function required_check($text,$key,$msg){
	global $errors;
	$text = sanitize_input($text);
	if(empty($text)){
		$errors[$key] = $msg;
	}
}
//check for empty string
function empty_check($text,$key,$msg){
	global $errors;
	$text = sanitize_input($text);
	if(!isset($text)){
		$errors[$key] = $msg;
	}
}
//validation for single text fields 
function valid_name_check($text,$key,$msg){
	global $errors,$name_pattern;
	$text = sanitize_input($text);
	if(!empty($text) && !preg_match($name_pattern,$text)){
		$errors[$key] = $msg;
	}
}

//return the errors associative array
function get_errors(){
	return $GLOBALS['errors'];
}

//returns a message for sucessful operation
function get_sucess($msg){
	return "<span class='success'>".$msg."</span>";
}

//returns a message for error in operation
function get_failure($msg){
	return "<span class='merrors'>".$msg."</span>";
}

//all login related validation
function login_validation($email,$pass){
	global $cross_emote,$errors,$conn;
	$email = sanitize_input($email);
	$pass = sanitize_input($pass);
	$result = validate_login($email,$pass);
	if($result !== Null){
		$data = $result->get_result();

		if($data->num_rows == 0){
			$errors['mail_err'] = "Invalid mail or user doesn't exist ";
			$errors['pass_err'] = "Invalid password or user doesn't exist ";
		}
		else{

			$data = $data->fetch_assoc();
			$result->close();
			$conn->close();
			return $data;
		}
		
	}

	
}
//check whether user is creating an account 
// using same username,password or mail 
//for seconnd time
function check_duplicate($uname,$pass,$mail){
	global $cross_emote,$errors,$conn;
	$uname = sanitize_input($uname);
	$mail = sanitize_input($mail);
	$pass = sanitize_input($pass);
	$result = validate_registration($uname,$pass,$mail);
	if($result !== Null){
    	$data = $result->get_result();
    	if($data->num_rows >= 1){
		$errors['uname_err'] = "Account with same username or email or password already exists ";
		$errors['mail_err'] = "Account with same username or email or password already exists ";
		$errors['pass_err'] = "Account with same username or email or password already exists ";
		}
		$result->close();
    	$conn->close();
    }

}

//check whether old password matches
//when updating password
//else give error message
function check_validPass($pass,$id){
	global $errors,$cross_emote;
	$pass = sanitize_input($pass);
	$result = valid_pass($id,$pass);
	if($result !== Null){
		$data = $result->get_result();
		if($data->num_rows == 0){
			$errors['pass_err'] = "Given password doesn't match ";
		}
	}
}

//check whether username and email matches
//when reseting password
//else print error message
function resetpass_validation($uname,$email){
	global $errors,$cross_emote;
	$uname= sanitize_input($uname);
	$email = sanitize_input($email);
	$result = passwordReset_validation($uname,$email);
	if($result !== null){
		$data = $result->get_result();
		if($data->num_rows == 0){
			$errors['uname_err'] = "Invalid username or account doesnt't exist ";
			$errors['mail_err'] = "Invalid email or account doesnt't exist ";
		}
		else{
			$out = $data->fetch_assoc();
			return $out;
		}
	}
	// if($out < 0){
	// 	$errors['uname_err'] = "Invalid username or account doesnt't exist ".$cross_emote;
	// 	$errors['mail_err'] = "Invalid email or account doesnt't exist ".$cross_emote;
	// }else{
	// 	return $out;
	// }
}	

//checks whether starttime is less than
//end time
function validate_time($stime,$etime){
	global $errors,$cross_emote;
	$stime = sanitize_input($stime);
	$etime = sanitize_input($etime);
	if(!empty($stime) && !empty($etime)){
		if(strtotime($stime) >= strtotime($etime)){
			$errors['stime_err'] = "Start time is greater or equal to end time ";
			$errors['etime_err'] = "Start time is greater or equal to end time ";
		}
	}
}

//checks whether the time given follows valid
//time format
function valid_time_check($time,$key,$msg){
	global $errors,$cross_emote,$time_pattern;
	$time = sanitize_input($time);
	if(!preg_match($time_pattern,$time)){
		$errors[$key] = $msg;
	}
}

//checks whether the date given follows valid
//date format
function valid_date_check($date,$key,$msg){
	global $errors,$cross_emote;
	$date = sanitize_input($date);
	$date = date_parse($date);
	if($date['error_count'] !== 0){
		$errors[$key] = $msg;
	}
}

//set custom error message 
//for the error array
//with a key and a message
function setErrorMsg($key,$msg){
	global $errors,$cross_emote;
	$errors[$key] = $msg;
}