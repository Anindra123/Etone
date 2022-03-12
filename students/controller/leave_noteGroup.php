<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
if(isset($_GET['uid'])){
	$_SESSION['uid'] = +$_GET['uid'];
}
else{
	$_SESSION['uid'] = $_SESSION['id'];
}

require_once 'includes/removeUserData.php';

header('Location: ../view/student_noteGroup.php');
exit();