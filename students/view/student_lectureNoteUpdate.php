<?php 
session_start();
$_SESSION['page_name'] = 'Update Lecture Notes Page';
$page_title = "Update Lecture note";
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
if(isset($_GET['ln_id'])){
	$_SESSION['ln_id'] = +$_GET['ln_id'];
}
if(isset($_SESSION['ln_id']) && !isset($_SESSION['lnu_data'])){
	header('Location: ../controller/viewLectureNoteData.php');
	exit();
}
else{
	$data = (array) $_SESSION['lnu_data'];
}
require_once 'includes/header.php';

$errors = $_SESSION['ln_errors'] ?? [];

require_once 'includes/lectureNoteForm.php'; 

require_once 'includes/footer.php';

if(isset($_SESSION['ln_errors'])){
	unset($_SESSION['ln_errors']);
}
if(isset($_SESSION['lnu_data'])){
	unset($_SESSION['lnu_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
?>  