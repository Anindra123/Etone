<?php 
session_start();
if(isset($_COOKIE["auth_token"])){
	unset($_COOKIE["auth_token"]);
	setcookie("auth_token",null,-1,"/");

}
if(isset($_SESSION['otp'])){
	unset($_SESSION['otp']);
}
if(isset($_SESSION['NoOfTokens'])){
	unset($_SESSION['NoOfTokens']);
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
	<form action="../controller/forgot_pass_validation.php" method="post" onsubmit="return validateForgotPass(this)" novalidate>
		<span>
			<?php 

			$errors = $_SESSION['p_errors'] ?? [];
			$data = $_SESSION['p_data'] ?? [];
			if(isset($_SESSION['m_errors'])){
				echo '<br>';
				echo $_SESSION['m_errors'];
				echo '<br><br>';
				unset($_SESSION['m_errors']);
			}
			?>
		</span>
		<fieldset>
			<legend>Forgot password :</legend>
			<label for="uname">Enter your username *:</label>
			<br><br>
			<input type="text" name="uname"id="uname" 
			value="<?php echo $data['uname'] ?? '';?>">
			<br>
			<span class="err un"><?php echo $errors['uname_err'] ?? ''; ?></span>
			<br><br>
			<label for="mail">Enter your email *:</label>
			<br><br>
			<input type="text" name="mail"id="mail" 
			value="<?php echo $data['mail'] ?? '';?>">
			<br>
			<span class="err ms"><?php echo $errors['mail_err'] ?? ''; ?></span>
			<br><br>
			<input type="submit"> &nbsp; <a href="index.php">Go back to login page</a>
			<br><br>
		</fieldset>
	</form>
<script src="scripts/forgotpass.js"></script>
</body>
</html>
<?php 
if(isset($_SESSION['p_data']) && 
	isset($_SESSION['p_errors'])
)
{
	unset($_SESSION['p_data']);
	unset($_SESSION['p_errors']);
}


?>
