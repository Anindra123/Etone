<?php
session_start();
require_once 'includes/validations.php';
require_once '../model/dbDataAcess.php';

$fname = $lname =$mname =$mail = $uname = $pass = $cpass =$loe= $ins_name = "";
$errors = [];
$validated = false;

//perform the required validation and checking whether request method is post
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $mail = sanitize_input($_POST['mail']);
    $pass = sanitize_input($_POST['pass']);
    $uname = sanitize_input($_POST['uname']);
    $cpass = sanitize_input($_POST['cpass']);
    $fname = sanitize_input($_POST['fname']);
    $lname = sanitize_input($_POST['lname']);
    $mname = sanitize_input($_POST['mname']);
    $loe = sanitize_input($_POST['loe'] ?? '');
    $ins_name = sanitize_input($_POST['ins_name']);
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
else{
    $_SESSION['m_errors'] = get_failure("Cannot process get request ");
    header('Location: ../view/student_register.php');
    exit();
}
// if all validation done and no errors found then save
// the data in database
if(count($errors) === 0 && !isset($_SESSION['m_errors']) && $validated === true ){
    $data = array('mail' => $mail,
        'pass' => $pass,
        'uname' => $uname,
        'fname' => $fname,
        'lname' => $lname,
        'mname' => $mname,
        'loe' => $loe,
        'ins_name' => $ins_name
    );


    $result  = setStudentData($data);
    if($result !== Null){
       $_SESSION['success'] = get_sucess("Signed up sucessfully");
       if(isset($_SESSION['r_errors']) && isset($_SESSION['r_data'])){
        unset($_SESSION['r_errors']);
        unset($_SESSION['r_data']);
        }
    $result->close();
    $conn->close();
    header("Location: ../view/student_register.php");
    exit();
   }


}   
else{
   $data = array(
    'mail' => $mail,
    'pass' => $pass,
    'uname' => $uname,
    'fname' => $fname,
    'lname' => $lname,
    'mname' => $mname,
    'loe' => $loe,
    'ins_name' => $ins_name
);
   $_SESSION['r_errors'] = $errors;
   $_SESSION['r_data'] = $data;
   header("Location: ../view/student_register.php");
   exit();
}