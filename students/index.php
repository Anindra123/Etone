 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Etone : note management and planning app</title>
	<link rel="icon" type="image/x-icon" href="../public/img/notes3.ico">
 </head>
 <?php 
 	require_once 'validations.php';
 	$mail = $pass = "";
 	$errors = [];
 	$validate = false;
 	if($_SERVER['REQUEST_METHOD'] === "POST"){
 		global $mail,$pass,$errors,$validate;
 		$mail = $_POST['mail'];
 		$pass = $_POST['pass'];
 		email_validation($mail);
 		password_validation($pass);
 		$errors = get_errors();
 		$validate = true;
 		
 	}
 	if(count($errors) === 0 && $validate === true){
 		header('Refresh: 0; URL = student_dashboard.php');

 	}
 ?>
 <body>
 	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
 		<fieldset>
 			<legend>Student Sign In :</legend>
 			<br>
 			<label for="mail">Email *:</label>
 			<br><br>
 			<input type="email" name="mail" id="mail" autofocus value="<?php echo $mail; ?>">
 			<br>
 			<span><?php echo $errors['mail_err'] ?? '';?></span>
 			<br><br>
 			<label for="pass">Password *:</label>
 			<br><br>
 			<input type="password" name="pass" id="pass" value="<?php echo $pass; ?>">
 			<br>
 			<span><?php echo $errors['pass_err'] ?? '';?></span>
 			<br><br>
 			<button type="submit">Log In</button>&nbsp;&nbsp;<a href="">Forgot Password ?</a>
 			<br><br>
 			<p>Don't have an account ? <a href="student_register.php">Sign Up</a></p>
 			<br>
 		</fieldset>
 	</form>
 </body>
 </html>
