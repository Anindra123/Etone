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

<body>
  <form action="../controller/loginValidation.php" method="post" novalidate>
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
    <fieldset>
        <legend>Student Sign In :</legend>
        <br>
        <label for="mail">Email *:</label>
        <br><br>
        <input type="email" name="mail" id="mail" autofocus value="<?php echo $data['mail'] ?? ''; ?>">
        <br>
        <span><?php echo $errors['mail_err'] ?? '';?></span>
        <br><br>
        <label for="pass">Password *:</label>
        <br><br>
        <input type="password" name="pass" id="pass" value="<?php echo $data['pass'] ?? ''; ?>">
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
<?php 
if(isset($_SESSION['l_errors']) && isset($_SESSION['l_data'])){
    unset($_SESSION['l_errors']);
    unset($_SESSION['l_data']);
}
?>