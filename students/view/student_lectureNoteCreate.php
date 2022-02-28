<?php 
session_start();
$_SESSION['page_name'] = 'Create Lecture Notes Page';
$page_title = "Create New Lecture note";
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
if(isset($_GET['ln_id'])){
	$_SESSION['ln_id'] = +$_GET['ln_id'];
}
require_once 'includes/header.php';

$errors = $_SESSION['ln_errors'] ?? [];
$data = $_SESSION['ln_data'] ?? [];

require_once 'includes/lectureNoteForm.php'; 

require_once 'includes/footer.php';

if(isset($_SESSION['ln_errors'])){
	unset($_SESSION['ln_errors']);
}
if(isset($_SESSION['ln_data'])){
	unset($_SESSION['ln_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
?>  