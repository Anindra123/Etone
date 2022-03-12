<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/noteGroup.json");
if(isset($_SESSION['g_id'])){
	$id = $_SESSION['g_id'];
	discardNoteGroup($id,get_fileName());
}
if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
header('Location: ../view/student_noteGroup.php');
exit();