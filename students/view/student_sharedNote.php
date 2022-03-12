<?php
session_start();
$_SESSION['page_name'] = 'Shared Lecture Notes Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$ng_data = [];
$ln_data = [];
$data = null;

if(isset($_GET['lp_id'])){
	$_SESSION['pid'] = +$_GET['lp_id'];
}
if(isset($_GET['uid'])){
	$_SESSION['uid'] = +$_GET['uid'];
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
			echo '&nbsp;';
			echo '&nbsp;';
			echo "<a href=student_noteGroupUsers.php>Members list</a>";
			echo '&nbsp;';
			echo '&nbsp;';
			echo "<a href=student_updateNoteGroup.php>Update Group Info</a>";
			echo '&nbsp;';
			echo '&nbsp;';
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
if(!isset($_SESSION['ln_data'])){
	header('Location: ../controller/viewLectureNoteData.php');
	exit();
}
else{
	$ln_data = $_SESSION['ln_data'];
}?>
<hr>
<a href="student_noteGroup.php">Go Back</a>
<hr>
<?php 
if(isset($_SESSION['success'])){
	echo '<br>';
	echo $_SESSION['success'];
	echo '<br><br>';
}
if(isset($_SESSION['m_errors'])){
	echo '<br>';
	echo $_SESSION['m_errors'];
	echo '<br><br>';
}
if(count($ln_data) === 0){
	if(isset($_SESSION['success'])){
		unset($_SESSION['success']);
	}
	if(isset($_SESSION['m_errors'])){
		unset($_SESSION['m_errors']);
	}
	if(isset($_SESSION['ln_data'])){
		unset($_SESSION['ln_data']);
	}
	if(isset($_SESSION['ln_errors'])){
		unset($_SESSION['ln_errors']);
	}
	echo '<br>';	
	echo '<strong>No lecture notes added</strong>';
	echo '<br>';
	require_once 'includes/footer.php';
	exit();
}

?>

<table border="1">
	<thead>
		<tr>
			<th>Notes</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		for ($i=0; $i < count($ln_data); $i++) { 
			$id = $ln_data[$i]->id;
			echo '<tr>';
			echo '<td>';
			echo $ln_data[$i]->tname;
			echo '</td>';
			echo '<td>';
			echo "<a href=student_sharedNoteShow.php?ln_id=$id>View</a>";
			echo '&nbsp;';
			echo '</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>
<?php 
require_once 'includes/footer.php';
if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
if(isset($_SESSION['ln_data'])){
	unset($_SESSION['ln_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}
if(isset($_SESSION['ln_errors'])){
	unset($_SESSION['ln_errors']);
}
?>