<?php
session_start();
require_once 'validations.php';
require_once 'dataAcess.php';
$fname = $lname =$mname =$mail = $uname =$loe = $ins_name = "";
$errors = [];
$validated = false;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    global $mail,$fname,$lname,$mname,
    $uname,$loe,$ins_name;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $loe = $_POST['loe'] ?? '';
    $ins_name = $_POST['ins_name'];
    //email_validation($mail);
    name_validation($fname,$lname,$mname);
    //username_validation($uname);
    required_check($loe,"loe_err","Please select a level of education ");
    valid_name_check($ins_name,"ins_name_err",
        "Not a valid institution name ");
    $errors = get_errors();
    // if(count($errors) === 0){
    //     check_duplicate($uname,$pass,$mail);
    //     $errors = get_errors();
    // }
    $validated = true;
}



if(count($errors) === 0 && $validated === true ){
    global $mail,$fname,$lname,$mname,
    $uname,$loe,$ins_name;
    $data = array(
        'fname' => $fname,
        'lname' => $lname,
        'mname' => $mname,
        'loe' => $loe,
        'ins_name' => $ins_name
    );

    $id = $_SESSION['id'] ?? '';
    update_studentData($data,$id);

    $_SESSION['success'] = get_sucess("Updated sucessfully");
    if(isset($_SESSION['u_errors'])){
        unset($_SESSION['u_errors']);
    }
    header("Location: student_updateAccount.php");
    exit();
}
else{

    global $mail,$pass,$fname,$lname,$mname,
    $uname,$loe,$ins_name,$errors;
    // $data = array('id'=>Null,
    //     'mail' => $mail,
    //     'pass' => $pass,
    //     'uname' => $uname,
    //     'fname' => $fname,
    //     'lname' => $lname,
    //     'mname' => $mname,
    //     'loe' => $loe,
    //     'ins_name' => $ins_name
    // );
    $_SESSION['u_errors'] = $errors;
    // $_SESSION['data'] = $data;
    header("Location: student_updateAccount.php");
    exit();
}