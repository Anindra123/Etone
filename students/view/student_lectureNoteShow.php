<?php 
session_start();
$_SESSION['page_name'] = 'Show Lecture Notes Page';
$page_title = "Update Lecture note";
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
if(isset($_GET['ln_id'])){
	$_SESSION['ln_id'] = +$_GET['ln_id'];
}
if(isset($_SESSION['ln_id']) && !isset($_SESSION['lns_data'])){
	header('Location: ../controller/viewLectureNoteData.php');
	exit();
}
else{
	$data = (array) $_SESSION['lns_data'];
}
require_once 'includes/header.php';

?>

<span><b>Title :</b> <?php echo $data['tname'] ?? '';?></span>
<br><br>

<span><b>Lecture Date : </b><?php echo date('Y-m-d',strtotime($data['ldate'])) ?? '';?></span>
<br><br>

<span><b>Lecture Time :</b> <?php echo date('g:i A',strtotime($data['ltime'])) ?? '';?></span>
<br><br>
<b><i>Note :</i></b>
<pre><?php echo $data['notes'] ?? '';?></pre>
<br>
<a href="student_lectureNotes.php">Go Back</a>
<?php
require_once 'includes/footer.php';
if(isset($_SESSION['lns_data'])){
	unset($_SESSION['lns_data']);
}