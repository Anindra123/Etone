<?php
session_start();
$_SESSION['page_name'] = 'Update Class Schedule Page';
$data = [];
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
if(isset($_GET['sc_id'])){
	$_SESSION['sc_id'] = +$_GET['sc_id'];
}

if(!isset($_SESSION['scu_data'])){
	header('Location: ../controller/viewWeeklyScheduleData.php');
	exit();
}
else{
	$data =(array)$_SESSION['scu_data'];
}
require_once 'includes/header.php';
$page_title = 'Update class schedule';
$errors = $_SESSION['sc_errors'] ?? [];
require_once 'includes/classScheduleForm.php';

if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}
if(isset($_SESSION['scu_data'])){
	unset($_SESSION['scu_data']);
}
if(isset($_SESSION['sc_errors'])){
	unset($_SESSION['sc_errors']);
}
require_once 'includes/footer.php';
?>