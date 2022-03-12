<?php 
session_start();

if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$_SESSION['page_name'] = 'Note Group Users Page';
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
		echo "<a href='student_updateNoteGroup.php'>Update Group Info</a>";
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
	echo '<hr>';
	$note_viewers = $data->note_viewers;
	echo '<table border=1>';
	if($_SESSION['user_type'] === 'gc'){
		echo '<thead>';
		echo '<tr>';
		echo '<th>';
		echo 'id';
		echo '</th>';
		echo '<th>';
		echo 'username';
		echo '</th>';
		echo '<th>';
		echo 'mail';
		echo '</th>';
		echo '<th>';
		echo 'Role';
		echo '</th>';
		echo '<th>';
		echo 'Action';
		echo '</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		for ($i=0; $i < count($note_viewers); $i++) { 
			$id = $note_viewers[$i]->id;
			echo '<tr>';
			echo '<td>';
			echo $note_viewers[$i]->id;
			echo '</td>';
			echo '<td>';
			echo $note_viewers[$i]->name;
			echo '</td>';
			echo '<td>';
			echo $note_viewers[$i]->mail;
			echo '</td>';
			echo '<td>';
			if($note_viewers[$i]->role === "gc"){
				echo 'Group Creator';
			}
			else{
				echo 'Note Viewer';
			}
			echo '</td>';
			echo '<td>';
			if($note_viewers[$i]->role === "v"){
				echo "<a href='../controller/leave_noteGroup.php?uid=$id'> Remove User </a>";
			}
			else{
				echo "";
			}
			echo '</td>';
			echo '</tr>';
		}
		echo '</tbody>';
	}else{
		echo '<thead>';
		echo '<tr>';
		echo '<th>';
		echo 'id';
		echo '</th>';
		echo '<th>';
		echo 'username';
		echo '</th>';
		echo '<th>';
		echo 'mail';
		echo '</th>';
		echo '<th>';
		echo 'Role';
		echo '</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		for ($i=0; $i < count($note_viewers); $i++){
			echo '<tr>';
			echo '<td>';
			echo $note_viewers[$i]->id;
			echo '</td>';
			echo '<td>';
			echo $note_viewers[$i]->name;
			echo '</td>';
			echo '<td>';
			echo $note_viewers[$i]->mail;
			echo '</td>';
			echo '<td>';
			if($note_viewers[$i]->role === "gc"){
				echo 'Group Creator';
			}
			else{
				echo 'Note Viewer';
			}
			echo '</td>';
			echo '</tr>';
		}
		echo '</tbody>';
	}
	echo '</table>';
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
if(isset($_SESSION['g_users'])){
	unset($_SESSION['g_users']);
}