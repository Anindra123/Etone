<?php 
session_start();
$id = $_SESSION['id'] ;

require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';

if(isset($_GET['submit'])){
	if($_GET['submit'] === "yes"){
		set_type("f","../model/lectureNoteData.json");
		delete_account($id,get_fileName());
		set_type("f","../model/lecturePlanData.json");
		delete_account($id,get_fileName());
		set_type("f","../model/scheduleClass.json");
		delete_account($id,get_fileName());
		set_type("f","../model/scheduleWeek.json");
		delete_account($id,get_fileName());
		set_type("f","../model/student_taskData.json");
		delete_account($id,get_fileName());
		set_type("f","../model/students.json");
		delete_account($id,get_fileName(),true);
		header("Location: ../view/logout.php");
		exit();
	}
	else{
		header("Location: ../view/student_tasks.php");
		exit();
	}
}