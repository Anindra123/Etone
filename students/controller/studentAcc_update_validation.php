<?php
session_start();
require_once 'validations.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/students.json");
$fname = $lname =$mname =$mail = $uname =$loe = $ins_name = "";
$errors = [];
$validated = false;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $fname = sanitize_input($_POST['fname']);
    $lname = sanitize_input($_POST['lname']);
    $mname = sanitize_input($_POST['mname']);
    $loe = sanitize_input($_POST['loe'] ?? '');
    $ins_name = sanitize_input($_POST['ins_name']);
    
    name_validation($fname,$lname,$mname);
    required_check($loe,"loe_err","Please select a level of education ");
    valid_name_check($ins_name,"ins_name_err",
        "Not a valid institution name ");
    $errors = get_errors();
    $validated = true;
}else{
    $_SESSION['m_errors'] = get_failure("Cannot process get request ");
    header('Location: ../view/student_updateAccount.php');
    exit();
}



if(count($errors) === 0 && $validated === true ){
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
    $_SESSION['full_name'] = $fname.' '.$mname.' '.$lname;
    if(isset($_SESSION['u_data'])){
        unset($_SESSION['u_data']);
    }
    header("Location: ../view/student_updateAccount.php");
    exit();
}
else{
    $data = array('id'=>Null,    
        'fname' => $fname,
        'lname' => $lname,
        'mname' => $mname,
        'loe' => $loe,
        'ins_name' => $ins_name
    );
    $_SESSION['u_data'] = $data;
    $_SESSION['u_errors'] = $errors;
    header("Location: ../view/student_updateAccount.php");
    exit();
}