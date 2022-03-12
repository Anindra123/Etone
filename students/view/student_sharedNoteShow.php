<?php 
session_start();
$_SESSION['page_name'] = 'Show Shared Lecture Notes Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$ng_data = [];
$lns_data = [];
$data = null;

if(isset($_GET['ln_id'])){
	$_SESSION['ln_id'] = +$_GET['ln_id'];
}

if(!isset($_SESSION['ng_data'])){
	header('Location: ../controller/viewNoteGroupData.php');
	exit();
}
else{
	$ng_data = $_SESSION['ng_data'];
}
require_once 'includes/header.php';
require_once '../controller/includes/getGroupID.php';
if(count($ng_data) > 0){
	$data = getData();
	echo '<b>';
	echo $data->gname;
	echo '</b>';
	echo '&nbsp';
	if($_SESSION['user_type'] === 'gc'){
		echo "<a href=student_noteGroup.php>Shared Notes</a>";
		echo "&nbsp;";
		echo "&nbsp;";
		echo "<a href=student_noteGroupUsers.php>Members list</a>";
		echo "&nbsp;";
		echo "&nbsp;";
		echo "<a href=student_updateNoteGroup.php>Update Group Info</a>";
		echo "&nbsp;";
		echo "&nbsp;";
		echo "<a href=../controller/discard_noteGroup.php>Discard Group</a>";
	}
	else if($_SESSION['user_type'] === 'v'){
		echo "<a href=student_noteGroup.php>Shared Notes</a>";
		echo '&nbsp;';
		echo "<a href=student_noteGroupUsers.php>Members list</a>";
		echo '&nbsp;';
		echo "<a href=../controller/leave_noteGroup.php>Leave Group</a>";
	}
	else{
		echo '<br>';
		echo '<b>No group created currently</b>';
		echo '<br><br>';
		echo '<a href=student_createNoteGroup.php>Create Note Group </a>';
		echo '<br><br>';
		require_once 'includes/footer.php';

		if(isset($_SESSION['ng_data'])){
			unset($_SESSION['ng_data']);
		}
		exit();
	}
}
else{
	echo '<br>';
	echo '<b>No group created currently</b>';
	echo '<br><br>';
	echo '<a href=student_createNoteGroup.php>Create Note Group </a>';
	echo '<br><br>';
}

if(!isset($_SESSION['lns_data'])){
	header('Location: ../controller/viewLectureNoteData.php');
	exit();
}
else{
	$lns_data = (array) $_SESSION['lns_data'];
}

?>
<br><br>
<span><b>Title :</b> <?php echo $lns_data['tname'] ?? '';?></span>
<br><br>

<span><b>Lecture Date : </b><?php echo $lns_data['ldate'] ?? '';?></span>
<br><br>

<span><b>Lecture Time :</b> <?php echo $lns_data['ltime'] ?? '';?></span>
<br><br>
<b><i>Note :</i></b>
<pre><?php echo $lns_data['notes'] ?? '';?></pre>
<br>
<a href="student_noteGroup.php">Go Back</a>
<?php
require_once 'includes/footer.php';
if(isset($_SESSION['lns_data'])){
	unset($_SESSION['lns_data']);
}
if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
?>