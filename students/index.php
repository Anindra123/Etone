<?php
    session_start();
?>

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
    require_once 'dataAcessType.php';
    set_type("f","students.json");
 	$mail = $pass = "";
 	$errors = [];
 	$validate = false;
    $data = [];
    if(isset($_SESSION['r_errors']) && isset($_SESSION['r_data'])){
        unset($_SESSION['r_errors']);
        unset($_SESSION['r_data']);
    }
    if(isset($_COOKIE['count'])){
        setcookie('count','',time()-3600);
    }
 	if($_SERVER['REQUEST_METHOD'] === "POST"){
 		$mail = $_POST['mail'];
 		$pass = $_POST['pass'];
 		email_validation($mail);
 		password_validation($pass);
        
 		$errors = get_errors();
        if(count($errors) === 0){
            $data = login_validation($mail,$pass);
            $errors = get_errors();
        }
 		$validate = true;
 		
 	}
 	if(count($errors) === 0 && $validate === true){
 		header('Location: student_dashboard.php');
        $_SESSION['id'] = $data->id;
        $_SESSION['full_name'] = $data->fname." ".$data->mname." ".$data->lname;
        $_SESSION['page_name'] = "Daily Tasks Page";
 	    exit();
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
 			<button type="submit">Log In</button>&nbsp;&nbsp;
            <a href="forgot_pass.php">Forgot Password ?</a>
 			<br><br>
 			<p>Don't have an account ? <a href="student_register.php">Sign Up</a></p>
 			<br>
 		</fieldset>
 	</form>
 </body>
 </html>
