<?php 
	session_start();
	require_once '../model/dataAcess.php';
	require_once '../model/dataAcessType.php';
	set_type("f","../model/students.json");
	$id = $_SESSION['id'];
	if(!isset($_SESSION['u_data'])){
		$_SESSION['u_data'] = get_studentAccData($id);
		
	}
	if($_SESSION['page_name'] === 'Update Account Info Page'){
		header('Location: ../view/student_updateAccount.php');
	}
	else{
		header('Location: ../view/student_viewAccount.php');
	}
	exit();

