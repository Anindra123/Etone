<?php 
session_start();
require_once '../model/dbDataAcess.php';

$id = $_SESSION['id'];

if($_SESSION['page_name'] === 'Update Account Info Page'){
	$result = getStudentData($id);
	if($result != Null){
		$data  = $result->get_result();
		if($data->num_rows >= 1){
			$_SESSION['u_data'] = $data->fetch_assoc();
		}
	}
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
	$result = getStudentData($id);
	if($result != Null){
		$data  = $result->get_result();
		if($data->num_rows >= 1){
			$_SESSION['u_data'] = $data->fetch_assoc();
		}
	}
	header('Location: ../view/student_viewAccount.php');
	exit();
}


