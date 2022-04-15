<?php 
session_start();


$otpNo = mt_rand(10000,99999);
$token = hash('sha256', $otpNo);

if(!isset($_COOKIE["auth_token"]) && !isset($_SESSION['otp'])){
	setcookie("auth_token",$token,time()+60,"/");
	$_SESSION['otp'] = $otpNo;
	$_SESSION['expire_time'] = time()+60;
	$_SESSION['NoOfTokens'] = 1;
}
if(isset($_GET['genNew'])){
	if(!isset($_COOKIE["auth_token"]) && !isset($_SESSION['otp'])){
		$otpNo = mt_rand(10000,99999);
		$token = hash('sha256', $otpNo);
		setcookie("auth_token",$token,time()+60,"/");
		$_SESSION['otp'] = $otpNo;
		$_SESSION['expire_time'] = time()+60;
	}
}

header('Location: ../view/authorizeUser.php');
exit();

