<?php 
session_start();
if(!isset($_SESSION['u_id'])){
	header("Location: logout.php");
	exit();
}

if(!isset($_SESSION['NoOfTokens'])){
	if(!isset($_COOKIE["auth_token"]) && !isset($_SESSION['otp'])){
		header('Location: ../controller/generateOTP.php');
		exit();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Etone : note management and planning app</title>
	<link rel="icon" type="image/x-icon" href="../../public/img/notes3.ico">
	<link rel="stylesheet" href="styles/style.css">
</head>
<body>
	<span>
		<?php 
		date_default_timezone_set('Asia/Dhaka');
		$errors = $_SESSION['o_error'] ?? [];
		$data = $_SESSION['o_data'] ?? [];
		if(isset($_SESSION['otp']) && isset($_SESSION['expire_time'])){
			echo '<br>';
			echo 'Generated OTP :'.$_SESSION['otp'];
			echo '<br>';
			echo 'Expire time :'.date("h:i:s a",$_SESSION['expire_time']);
			echo '<br><br>';
		}
		else{
			echo '<br>';
			echo 'OTP expired';
			echo '<br><br>';
		}
		if(count($errors) === 0 && isset($_SESSION['success']))
		{
			echo '<br>';
			echo $_SESSION['success'];
			echo '<br><br>';
			unset($_SESSION['success']);
		}
		if(isset($_SESSION['m_errors'])){
			echo '<br>';
			echo $_SESSION['m_errors'];
			echo '<br><br>';
			unset($_SESSION['m_errors']);
		}
		?>
	</span>
	<form action="../controller/validateOTP.php" method="post">
		<fieldset>
			<legend>Validate OTP</legend>
			<label for="otp">Enter the generated otp provided to confirm authoriztion (otp is valid for 1 min) :</label>
			<br><br>
			<input type="text" name="otp" id="otp" value="<?php echo $data['otp_data'] ?? '';?>">
			<br>
			<span class="err otp">
				<?php 
				echo $errors['otp_err'] ?? '';
				?>
			</span>
			<br><br>
			<input type="submit" name="">
			&nbsp;
			<a href="forgot_pass.php">Go back</a>
		</fieldset>
	</form>
	<br>
	<a style="pointer-events: initial;" href="../controller/generateOTP.php?genNew=True"><button >Generate new OTP</button></a>
</body>
</html>

<?php 
if(isset($_SESSION['o_error'])){
	unset($_SESSION['o_error']);
}
if(isset($_SESSION['o_data'])){
	unset($_SESSION['o_data']);
}
?>