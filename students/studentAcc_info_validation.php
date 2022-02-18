<?php
    session_start();
    require_once 'validations.php';
    require_once 'DataAcess.php';
    $fname = $lname =$mname =$mail = $uname = $pass = $cpass =$loe = $ins_name = "";
    $errors = [];
    $validated = false;
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        global $mail,$pass,$fname,$lname,$mname,
        $cpass,$uname,$pass,$loe,$ins_name,$errors;
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
        if(count($errors) === 0){
            check_duplicate($uname,$pass,$mail);
            $errors = get_errors();
        }
        $validated = true;
    }

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

                
        set_studentData($data);

        $_SESSION['success'] = get_sucess("Signed up sucessfully");
        if(isset($_SESSION['errors']) && isset($_SESSION['data'])){
            unset($_SESSION['errors']);
            unset($_SESSION['data']);
        }
        header("Location: student_register.php");
        exit();
    }   
    else{
        
        global $mail,$pass,$fname,$lname,$mname,$cpass,
        $uname,$pass,$loe,$ins_name,$errors;
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
        $_SESSION['errors'] = $errors;
        $_SESSION['data'] = $data;
        header("Location: student_register.php");
        exit();
    }