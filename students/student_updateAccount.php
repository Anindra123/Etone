<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
        <span>
        <?php 
            if(count($errors) === 0 && $validated === true ){
                global $mail,$pass,$fname,$lname,$mname,$cpass,
                $uname,$pass,$loe,$ins_name;
                $data = array('id'=>Null,
                    'mail' => $mail,
                    'pass' => $pass,
                    'uname' => $uname,
                    'fname' => $fname,
                    'lname' => $lname,
                    'mname' => $mname,
                    'loe' => $loe,
                    'ins_name' => $ins_name
                );
                echo '<br>';
                echo get_sucess("Updated sucessfully");
                echo '<br><br>';
                require_once 'DataAcess.php';
                set_studentData($data,FILENAME);
            }   
            else{
                echo '';
            }
        ?>
        </span>
        
        <fieldset>
            <legend>Your current information :</legend>
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
        </fieldset>
        <br>
        <button type="submit">Sign Up</button>
        <br>