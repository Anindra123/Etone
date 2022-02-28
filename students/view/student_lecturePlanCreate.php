<?php 
session_start();
$_SESSION['page_name'] = 'Create Lecture Plan Page';
$page_title = "Create New Lecture plan";
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
require_once 'includes/header.php';

$errors = $_SESSION['lp_errors'] ?? [];
$data = $_SESSION['lp_data'] ?? [];

require_once 'includes/lecturePlanForm.php'; 

require_once 'includes/footer.php';

if(isset($_SESSION['lp_errors'])){
	unset($_SESSION['lp_errors']);
}
if(isset($_SESSION['lp_data'])){
	unset($_SESSION['lp_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
?>  