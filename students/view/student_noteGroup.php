<?php 
session_start();

if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$_SESSION['page_name'] = 'Note Group Page';
$ng_data = [];
$note_viewers = [];
$id = $_SESSION['id'];
$is_gc = false;
$is_user = false;
$data = Null;
//collect note group data and put it in a 
//session
if(!isset($_SESSION['ng_data'])){
	header('Location: ../controller/viewNoteGroupData.php');
	exit();
}
else{
	$ng_data = $_SESSION['ng_data'];
}

require_once 'includes/header.php';
require_once '../controller/includes/getGroupID.php';
//check whether any group has been created
if(count($ng_data) > 0){
	
	$data = getData() ?? Null;
	
	if(isset($data)){
		echo '<b>';
		echo $data->gname;
		echo '</b>';
		echo '&nbsp';
		if($is_gc === true && $is_user === true){
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
		else if($is_user){
			echo "<a href=student_noteGroup.php>Shared Notes</a>";
			echo '&nbsp;';
			echo "<a href=student_noteGroupUsers.php>Members list</a>";
			echo '&nbsp;';
			echo "<a href=../controller/leave_noteGroup.php>Leave Group</a>";
		}
		
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
	echo '<hr>';
	$note_data = $data->shared_notes[0] ?? Null;
	if(!isset($note_data)){
		echo '<br>';
		echo '<b>No note data shared</b>';
		echo '<br><br>';
	}
	else{
		$shared = [];
		$name = "";
		if(!isset($_SESSION['slp_data'])){
			header('Location: ../controller/viewLecturePlannerData.php');
			exit();
		}
		else{
			$shared = $_SESSION['slp_data'];
		}
		for ($i=0; $i < count($shared); $i++) {
			$data = $shared[$i];
			$id = $data['data']->id;
			$uid = $data['data']->uid;
			$owner_name = $data['owner_name'];
			echo "<h3>$owner_name lecture plan</h3>";
			echo '<table border=1>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>';
			echo 'Subject Name';
			echo '</th>';
			echo '<th>';
			echo 'Topics Covered';
			echo '</th>';
			echo '<th>';
			echo 'Action';
			echo '</th>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			echo '<tr>';
			echo '<td>';
			echo $data['data']->sname;
			echo '</td>';
			echo '<td>';
			echo $data['data']->topics;
			echo '</td>';
			echo '<td>';
			echo "<a href='student_sharedNote.php?lp_id=$id&uid=$uid'>Check Notes</a>";
			echo '</td>';
			echo '</tr>';
			echo '</tbody>';
			echo '</table>';
		}
		
	}
}
else{
	echo '<br>';
	echo '<b>No group created currently</b>';
	echo '<br><br>';
	echo '<a href=student_createNoteGroup.php>Create Note Group </a>';
	echo '<br><br>';
}

require_once 'includes/footer.php';

if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
if(isset($_SESSION['slp_data'])){
	unset($_SESSION['slp_data']);
}
if(isset($_SESSION['g_users'])){
	unset($_SESSION['g_users']);
}