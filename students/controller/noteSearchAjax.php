<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$query = $uid = $pid = "";
$uid = $_SESSION['id'];
$pid = $_SESSION['pid'];
$errors = [];
$search = [];
$err = false;
$validated = false;
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$query = sanitize_input($_GET['n_name']);
	if(!empty($query)){
		$s_data = searchNoteData($uid,$pid,$query);
		if($s_data !== null){
			$s_data = $s_data->get_result();
			if($s_data->num_rows === 1){
				$search = $s_data->fetch_assoc();
			}
			else{
				$err = true;
			}	
		}
		
	}
	
	$validated = true;
}




if($err === false && $validated === true){
	echo '<table>';
	echo '<thead>';
	echo '<tr>';
	echo '<th>';
		echo 'Notes';
	echo '</th>';
	echo '<th>';
		echo 'Action';
	echo '</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';
				$id = $search['id'];
				echo '<td>';
				echo $search['tname'];
				echo '</td>';
				echo '<td>';
				echo "<a href='student_lectureNoteShow.php?ln_id=$id' style='pointer-events: initial;'><button>View</button></a>";
				echo '&nbsp;';
				echo "<a href='student_lectureNoteUpdate.php?ln_id=$id' style='pointer-events: initial;'><button>Update</button></a>";
				echo '&nbsp;';
				echo "<a href='../controller/lectureNote_delete.php?ln_id=$id' style='pointer-events: initial;'><button style='background-color: indianred;'>Delete</button></a>";
				echo '&nbsp;';
				echo '</td>';
				echo '</tr>';
	echo '</tbody>';
	echo '</table>';

}
else{
	echo "";
}