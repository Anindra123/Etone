<?php
session_start();
$_SESSION['page_name'] = 'Create Class Schedule Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
require_once 'includes/header.php';
$data = $_SESSION['sc_data'] ?? [];
$errors = $_SESSION['sc_errors'] ?? [];
$page_title = 'Add new class schedule';
require_once 'includes/classScheduleForm.php';
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}
if(isset($_SESSION['sc_data'])){
	unset($_SESSION['sc_data']);
}
if(isset($_SESSION['sc_errors'])){
	unset($_SESSION['sc_errors']);
}
require_once 'includes/footer.php';
?>