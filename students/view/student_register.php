<?php
session_start()
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Etone : note management and planning app</title>
  <link rel="icon" type="image/x-icon" href="../../public/img/notes3.ico">
  <link rel="stylesheet" href="styles/style.css">
  <style>
    input[type=email],input[type=password],input[type=text]{
    width: 90%;
    padding: 10px;
    margin: auto;
    font-size: 1vw;
}
</style>
</head>
 <?php 
        
        $errors = $_SESSION['r_errors'] ?? [];
        $data = $_SESSION['r_data'] ?? [];
        if(count($errors) === 0 && isset($_SESSION['success'])){
            echo '<br>';
            echo $_SESSION['success'];
            echo '<br><br>';
            session_unset();
            session_destroy();
        }
        if(isset($_SESSION['m_errors'])){
            echo '<br>';
            echo $_SESSION['m_errors'];
            echo '<br><br>';
            unset($_SESSION['m_errors']);
        }
        
?>
<body>
    <br><br>
    <form action="../controller/studentAcc_info_validation.php" method="post" onsubmit="return validateRegistration(this)" novalidate>
    <fieldset>
        <legend>Student Sign Up :</legend>
        <label for="fname">First Name *:</label>
        <br><br>
        <input type="text" name="fname"id="fname" autofocus 
        value= "<?php echo $data['fname'] ?? '';?>">
        <br>
        <span class="err fn"><?php echo $errors['fname_err'] ?? ''; ?></span>
        <br><br>
        <label for="mname">Middle Name:</label>
        <br>
        <input type="text" name="mname"id="mname" 
        value= "<?php echo $data['mname'] ?? '';?>">
        <br>
        <span class="err mn"><?php echo $errors['mname_err'] ?? ''; ?></span>
        <br><br>
        <label for="lname">Last Name *:</label>
        <br>
        <input type="text" name="lname" id="lname" 
        value= "<?php echo $data['lname'] ?? '';?>"> 
        <br>
        <span class="err ln"><?php echo $errors['lname_err'] ?? ''; ?></span>
        <br><br>    
        <label>Level of education * :</label>
        <br><br>
        <input type="radio" name="loe" value="Elementary"
        id="elem">
        <label for="elem">Elementary(1-5)</label>
        <input type="radio" name="loe" value="Middle School"
        id="ms">
        <label for="ms">Middle School(5-9)</label>
        <input type="radio" name="loe" value="High School"
        id="hs">
        <label for="hs">High School(9-12)</label>
        <input type="radio" name="loe" value="College"
        id="clge">
        <label for="clge">College(University)</label>
        <br><br>
        <span class="err loe"><?php echo $errors['loe_err'] ?? ''; ?></span>
        <br><br>
        <label for="ins_name">Institution name :</label>
        <br><br>
        <input type="text" name="ins_name" id="ins_name" 
        value="<?php echo $data['ins_name'] ?? '';?>">
        <br>
        <span class="err ins"><?php echo $errors['ins_name_err'] ?? ''; ?></span>
        <br><br>
    </fieldset>
    <br><br>
    <fieldset>
        <legend>Credentials:</legend>
        <label for="uname">Username *:</label>
        <br><br>
        <input type="text" name="uname"id="uname" 
        value="<?php echo $data['uname'] ?? '';?>">
        <br>
        <span class="err un"><?php echo $errors['uname_err'] ?? ''; ?></span>
        <br><br>
        <label for="mail">Email *:</label>
        <br><br>
        <input type="text" name="mail"id="mail" 
        value="<?php echo $data['mail'] ?? '';?>">
        <br>
        <span class="err ms"><?php echo $errors['mail_err'] ?? ''; ?></span>
        <br><br>
        <label for="pass">Password *:</label>
        <br><br>
        <input type="password" name="pass" id="pass" 
        value="<?php echo $data['pass'] ?? '';?>">
        <br>
        <span class="err ps"><?php echo $errors['pass_err'] ?? '';?></span>
        <br><br>
        <label for="cpass">Confirm Password *:</label>
        <br><br>
        <input type="password" name="cpass" id="cpass" 
        value="<?php echo $data['cpass'] ?? '';?>">
        <br>
        <span class="err cps"><?php echo $errors['cpass_err'] ?? '';?></span>
        <br><br>
    </fieldset>
    <br>
    <button type="submit">Sign Up</button>
    <br>
    <p> Already have an account ? <a href="index.php">Sign In</a></p>
</form>
<script src="scripts/register.js"></script> 
</body>
</html>
<?php 
if(isset($_SESSION['r_errors']) && isset($_SESSION['r_data'])){
    unset($_SESSION['r_errors']);
    unset($_SESSION['r_data']);
}
?>