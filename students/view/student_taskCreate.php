<?php 
session_start();
$_SESSION['page_name'] = 'Create Task Page';
$page_title = "Create New Task";
require_once 'header.php';

$errors = $_SESSION['t_errors'] ?? [];
$data = $_SESSION['t_data'] ?? [];

require_once 'task_form.php'; 

require_once 'footer.php';

if(isset($_SESSION['t_errors']) && isset($_SESSION['t_data'])){
	unset($_SESSION['t_errors']);
	unset($_SESSION['t_data']);
}
?>  