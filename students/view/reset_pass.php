<?php 
session_start();
if(!isset($_SESSION['count'])){
	$_SESSION['count'] = 0;
}
else{
	$_SESSION['count']++;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Etone : note management and planning app</title>
	<link rel="icon" type="image/x-icon" href="../public/img/notes3.ico">
</head>
<body>
	<form action="../controller/reset_pass_validation.php" method="post" novalidate>
		<fieldset>
			<span>
				<?php 
				$errors = $_SESSION['p_errors'] ?? [];
				$data = $_SESSION['p_data'] ?? [];
				
				if(isset($_SESSION['r_errors']))
				{
					echo '<br>';
					echo $_SESSION['r_errors'];
					echo '<br><br>';
					unset($_SESSION['r_errors']);
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
			<legend>Reset Password :</legend>
			<label for="pass">Enter a new password *:</label>
			<br><br>
			<input type="password" name="pass" id="pass" 
			value="<?php echo $data['pass'] ?? '';?>">
			<br>
			<span><?php echo $errors['pass_err'] ?? '';?></span>
			<br><br>
			<label for="cpass">Confirm Password *:</label>
			<br><br>
			<input type="password" name="cpass" id="cpass" 
			value="<?php echo $data['cpass'] ?? '';?>">
			<br>
			<span><?php echo $errors['cpass_err'] ?? '';?></span>
			<br><br>
			<button type="submit">Reset Password</button> &nbsp; <a href="logout.php">Go back to login page</a>
			<br><br>
		</fieldset>
	</form>
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