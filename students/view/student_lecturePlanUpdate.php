<?php 
session_start();
$_SESSION['page_name'] = 'Update Lecture Plan Page';
$page_title = "Update Lecture plan";
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
if(isset($_GET['lp_id'])){
	$_SESSION['lp_id'] = +$_GET['lp_id'];
}
if(isset($_SESSION['lp_id']) && !isset($_SESSION['lpu_data'])){
	header('Location: ../controller/viewLecturePlannerData.php');
	exit();
}
else{
	$data = (array) $_SESSION['lpu_data'];
}
require_once 'includes/header.php';

$errors = $_SESSION['lp_errors'] ?? [];

require_once 'includes/lecturePlanForm.php'; 

require_once 'includes/footer.php';

if(isset($_SESSION['lp_errors'])){
	unset($_SESSION['lp_errors']);
}
if(isset($_SESSION['lpu_data'])){
	unset($_SESSION['lpu_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
?>  