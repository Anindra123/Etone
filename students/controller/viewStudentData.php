<?php 
session_start();
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/students.json");
$id = $_SESSION['id'];

if($_SESSION['page_name'] === 'Update Account Info Page'){
	$_SESSION['u_data'] = getAllJsonData($id,get_fileName(),0,true);
	header('Location: ../view/student_updateAccount.php');
	exit();
}
else if($_SESSION['page_name'] === 'Create Note Group Page'){
	$_SESSION['u_data'] = getAllJsonData($id,get_fileName(),0,true);
	$data = (array) $_SESSION['u_data'];
	$data['role'] = 'gc';
	$_SESSION['u_data'] = $data;
	header('Location: ../view/student_createNoteGroup.php');
	exit();
}
else if($_SESSION['page_name'] === 'View Profile Page'){
	$_SESSION['u_data'] = getAllJsonData($id,get_fileName(),0,true);
	header('Location: ../view/student_viewAccount.php');
	exit();
}


