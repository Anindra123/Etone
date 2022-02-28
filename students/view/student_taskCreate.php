<?php 
session_start();
$_SESSION['page_name'] = 'Create Task Page';
$page_title = "Create New Task";
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
require_once 'includes/header.php';

$errors = $_SESSION['t_errors'] ?? [];
$data = $_SESSION['t_data'] ?? [];

require_once 'includes/task_form.php'; 

require_once 'includes/footer.php';

if(isset($_SESSION['t_errors'])){
	unset($_SESSION['t_errors']);
}
if(isset($_SESSION['t_data'])){
	unset($_SESSION['t_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
?>  