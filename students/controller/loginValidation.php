<?php 
session_start();
require_once 'includes/validations.php';
require_once '../model/dbDataAcess.php';

$mail = $pass = "";
$errors = [];
$validate = false;
$data = [];

if($_SERVER['REQUEST_METHOD'] === "POST"){
   $mail = sanitize_input($_POST['mail']);
   $pass = sanitize_input($_POST['pass']);
   email_validation($mail);
   password_validation($pass);

   $errors = get_errors();
   if(count($errors) === 0){
    $data = login_validation($mail,$pass);
    $errors = get_errors();
}
$validate = true;

}else{
    $_SESSION['m_errors'] = get_failure("Cannot process get request ");
    header('Location: ../view/index.php');
    exit();
}



if(count($errors) === 0 && !isset($_SESSION['m_errors']) && $validate === true){
    $_SESSION['id'] = $data['id'];
    $_SESSION['full_name'] = $data['fname']." ".$data['mname']." ".$data['lname']; 

    header('Location: ../view/student_tasks.php');
    exit();
}
else{
    $data = [ 'mail' => $mail,'pass' => $pass];
    $_SESSION['l_errors'] = $errors;
    $_SESSION['l_data'] = $data;
    header('Location: ../view/index.php');
    exit();
}