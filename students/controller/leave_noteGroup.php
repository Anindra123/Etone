<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/noteGroup.json");
if(isset($_GET['uid'])){
	$_SESSION['uid'] = +$_GET['uid'];
}
else{
	$_SESSION['uid'] = $_SESSION['id'];
}
require_once 'includes/removeUserData.php';
if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
if(isset($_SESSION['g_id'])){
	unset($_SESSION['g_id']);
}
header('Location: ../view/student_noteGroup.php');
exit();