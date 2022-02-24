<?php 
session_start();
$id = $_SESSION['id'] ;

require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/students.json");
if(isset($_GET['submit'])){
	if($_GET['submit'] === "yes"){
		delete_account($id);
		header("Location: ../view/logout.php");
		exit();
	}
	else{
		header("Location: ../view/student_tasks.php");
		exit();
	}
}