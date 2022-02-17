<!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Etone : note management and planning app</title>
	<link rel="icon" type="image/x-icon" href="../public/img/notes3.ico">
 </head>
 <?php
    define('FILENAME', 'students.json');
    $fname = $lname =$mname =$mail = $uname = $pass = $cpass =$loe = $ins_name = "";
    $errors = [];
    $validated = false;
    require_once 'validations.php';
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        global $mail,$pass,$fname,$lname,$mname,$cpass,$uname,$pass,$loe,$ins_name,$errors;
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $uname = $_POST['uname'];
        $cpass = $_POST['cpass'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $loe = $_POST['loe'];
        $ins_name = $_POST['ins_name'];
        email_validation($mail);
        password_validation($pass);
        name_validation($fname,$lname,$mname);
        username_validation($uname);
        confirm_pass_validation($cpass,$pass);
        required_check($loe,"loe_err","Please select a level of education ");
        valid_name_check($ins_name,"ins_name_err","Not a valid institution name ");
        $errors = get_errors();
        $validated = true;
    }
 ?>
 <body>
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
        <span>
        <?php 
            if(count($errors) === 0 && $validated === true ){
                global $mail,$pass,$fname,$lname,$mname,$cpass,$uname,$pass,$loe,$ins_name;
                $data = array('id'=>Null,
                    'mail' => $mail,
                    'pass' => $pass,
                    'unmame' => $uname,
                    'fname' => $fname,
                    'lname' => $lname,
                    'mname' => $mname,
                    'loe' => $loe,
                    'ins_name' => $ins_name
                );
                echo '<br>';
                echo get_sucess("Signed up sucessfully");
                echo '<br><br>';
                require_once 'DataAcess.php';
                set_studentData($data,FILENAME);
                $fname = $lname =$mname =$mail = $uname = $pass = $cpass =$loe = $ins_name = "";
            }   
            else{
                echo '';
            }
        ?>
        </span>
        
        <fieldset>
            <legend>Student Sign Up :</legend>
            <label for="fname">First Name *:</label>
            <br><br>
            <input type="text" name="fname"id="fname" autofocus 
            value= "<?php echo $fname;?>">
            <br>
            <span><?php echo $errors['fname_err'] ?? ''; ?></span>
            <br><br>
            <label for="mname">Middle Name:</label>
            <br>
            <input type="text" name="mname"id="mname" value= "<?php echo $mname;?>">
            <br>
            <span><?php echo $errors['mname_err'] ?? ''; ?></span>
            <br><br>
            <label for="lname">Last Name *:</label>
            <br>
            <input type="text" name="lname" id="lname" value= "<?php echo $lname;?>"> 
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
            <input type="text" name="ins_name" id="ins_name" value="<?php echo $ins_name;?>">
            <br>
            <span><?php echo $errors['ins_name_err'] ?? ''; ?></span>
            <br><br>
        </fieldset>
        <br><br>
        <fieldset>
            <legend>Credentials:</legend>
            <label for="uname">Username *:</label>
            <br><br>
            <input type="text" name="uname"id="uname" value="<?php echo $uname;?>">
            <br>
            <span><?php echo $errors['uname_err'] ?? ''; ?></span>
            <br><br>
            <label for="mail">Email *:</label>
            <br><br>
            <input type="text" name="mail"id="mail" value="<?php echo $mail;?>">
            <br>
            <span><?php echo $errors['mail_err'] ?? ''; ?></span>
            <br><br>
            <label for="pass">Password *:</label>
            <br><br>
            <input type="password" name="pass" id="pass" value="<?php echo $pass; ?>">
            <br>
            <span><?php echo $errors['pass_err'] ?? '';?></span>
            <br><br>
            <label for="cpass">Confirm Password *:</label>
            <br><br>
            <input type="password" name="cpass" id="cpass" value="<?php echo $cpass; ?>">
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