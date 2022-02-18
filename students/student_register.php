<?php
    session_start()
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
     <form action="studentAcc_info_validation.php" method="post" novalidate>
        <span>
        <?php 
                $errors = $_SESSION['errors'] ?? [];
                $data = $_SESSION['data'] ?? [];
                if(count($errors) === 0 && isset($_SESSION['success'])){
                    echo '<br>';
                    echo $_SESSION['success'];
                    echo '<br><br>';
                    session_unset();
                    session_destroy();
                }
        ?>
        </span>
        
        <fieldset>
            <legend>Student Sign Up :</legend>
            <label for="fname">First Name *:</label>
            <br><br>
            <input type="text" name="fname"id="fname" autofocus 
            value= "<?php echo $data['fname'] ?? '';?>">
            <br>
            <span><?php echo $errors['fname_err'] ?? ''; ?></span>
            <br><br>
            <label for="mname">Middle Name:</label>
            <br>
            <input type="text" name="mname"id="mname" 
            value= "<?php echo $data['mname'] ?? '';?>">
            <br>
            <span><?php echo $errors['mname_err'] ?? ''; ?></span>
            <br><br>
            <label for="lname">Last Name *:</label>
            <br>
            <input type="text" name="lname" id="lname" 
            value= "<?php echo $data['lname'] ?? '';?>"> 
            <br>
            <span><?php echo $errors['lname_err'] ?? ''; ?></span>
            <br><br>    
            <label for="loe">Level of education * :</label>
            <br><br>
            <select name="loe" id="loe">
                <option value="Elementary">Elementary</option>
                <option value="High-School">High-School</option>
                <option value="UnderGraduate">UnderGraduate</option>
                <option value="PostGraduate">PostGraduate</option>
            </select>
            <br>
            <span><?php echo $errors['loe_err'] ?? ''; ?></span>
            <br><br>
            <label for="ins_name">Institution name :</label>
            <br><br>
            <input type="text" name="ins_name" id="ins_name" 
            value="<?php echo $data['ins_name'] ?? '';?>">
            <br>
            <span><?php echo $errors['ins_name_err'] ?? ''; ?></span>
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
            <span><?php echo $errors['uname_err'] ?? ''; ?></span>
            <br><br>
            <label for="mail">Email *:</label>
            <br><br>
            <input type="text" name="mail"id="mail" 
            value="<?php echo $data['mail'] ?? '';?>">
            <br>
            <span><?php echo $errors['mail_err'] ?? ''; ?></span>
            <br><br>
            <label for="pass">Password *:</label>
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
        </fieldset>
        <br>
        <button type="submit">Sign Up</button>
        <br>
        <p> Already have an account ? <a href="index.php">Sign In</a></p>
     </form>
 </body>
 </html>