<?php 
session_start();
$_SESSION['page_name'] = 'Update Task Page';
$page_title = "Update Task";
$data = [];
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
if(isset($_GET['t_id'])){
	$_SESSION['t_id'] = +$_GET['t_id'];
}
if(isset($_SESSION['t_id']) && !isset($_SESSION['tu_data'])){
	header('Location: ../controller/viewTaskData.php');
	exit();
}
else{
	$data = (array) $_SESSION['tu_data'];
}
require_once 'includes/header.php';

$errors = $_SESSION['t_errors'] ?? [];

require_once 'includes/task_form.php'; 

require_once 'includes/footer.php';

if(isset($_SESSION['t_errors'])  ){
	unset($_SESSION['t_errors']);
}
if(isset($_SESSION['tu_data'])){
	unset($_SESSION['tu_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
?>  