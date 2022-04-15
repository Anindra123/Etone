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
	$data = $_SESSION['lns_data'];
}



require_once 'includes/header.php';

?>
<br><br>
<div id="lectureInfo">
<span><b>Title :</b> <?php echo $data['tname'] ?? '';?></span>
<br><br>
<span><b>Lecture Date : </b><?php 
	if(explode('-', $data['ldate'])[0] !== "0000"){
		echo date('d-m-Y',strtotime($data['ldate']));
	}	
	else{
		echo '';
	}
?></span>
<br><br>

<span><b>Lecture Time :</b> <?php 
	$time = explode(":",$data['ltime']);
	if($time[0] === "00" && $time[1] === "00" && $time[2] === "00"){
		echo '';
	}
	else{
		echo date('g:i A',strtotime($data['ltime']));
	}
?></span>
<br><br>
</div>
<br><br>
<div id="lectureInfo">
<b><i>Note :</i></b>
<pre><?php echo $data['notes'] ?? '';?></pre>
<br>
</div>
<br><br>
<div id="goBack">
<a href="student_lectureNotes.php" style="pointer-events:initial;" ><button>Go Back</button></a>
</div>
<?php
require_once 'includes/footer.php';
if(isset($_SESSION['lns_data'])){
	unset($_SESSION['lns_data']);
}