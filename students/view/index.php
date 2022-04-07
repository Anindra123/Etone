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
    <span>
        <?php 
        $errors = $_SESSION['l_errors'] ?? [];
        $data = $_SESSION['l_data'] ?? [];
        if(isset($_SESSION['m_errors'])){
            echo '<br>';
            echo $_SESSION['m_errors'];
            echo '<br><br>';
            unset($_SESSION['m_errors']);
        }
        ?>
    </span>
  <form action="../controller/loginValidation.php" method="post" onsubmit="return validateLogin(this)" novalidate>
    <fieldset>
        <legend>Student Sign In :</legend>
        <br>
        <label for="mail">Email *:</label>
        <br><br>
        <input type="email" name="mail" id="mail" autofocus value="<?php echo $data['mail'] ?? ''; ?>">
        <br>
        <span class="err ms"><?php echo $errors['mail_err'] ?? '';?></span>
        <br><br>
        <label for="pass">Password *:</label>
        <br><br>
        <input type="password" name="pass" id="pass" value="<?php echo $data['pass'] ?? ''; ?>">
        <br>
        <span class="err ps"><?php echo $errors['pass_err'] ?? '';?></span>
        <br><br>
        <input type="submit" value="Login"></input>&nbsp;&nbsp;
        <a href="forgot_pass.php">Forgot Password ?</a>
        <br><br>
        <p>Don't have an account ? <a href="student_register.php">Sign Up</a></p>
        <br>
    </fieldset>
</form>
<script src="scripts/login.js"></script>
</body>
</html>
<?php 
if(isset($_SESSION['l_errors']) && isset($_SESSION['l_data'])){
    unset($_SESSION['l_errors']);
    unset($_SESSION['l_data']);
}
?>