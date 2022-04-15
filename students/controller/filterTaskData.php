<?php 
session_start();
require_once '../model/dbDataAcess.php';
$id = $_SESSION['id'] ?? '';
$filter = "";
$filter_data = [];
$err = false;
if($_SERVER['REQUEST_METHOD'] === "GET"){
	if(isset($_GET['filter'])){
		$filter = $_GET['filter'];
	}
	$result = getTaskByStatus($id,$filter);
	if($result !== null){
		$data = $result->get_result();
		if($data->num_rows > 0){
			while($fdata = $data->fetch_assoc()){
				$filter_data[] = $fdata;
			}
		}
		else{
			$err = true;
		}
	}
}
if($err === false && !isset($_SESSION['m_errors'])){
	echo '<table>';
	echo '<thead>';
	echo '<tr>';
	echo '<th>';
	echo 'Title';
	echo '</th>';
	echo '<th>';
	echo 'Start Time';
	echo '</th>';
	echo '<th>';
	echo 'End Time';
	echo '</th>';
	echo '<th>';
	echo 'Status';
	echo '</th>';
	echo '<th>';
	echo 'Date';
	echo '</th>';
	echo '<th>';
	echo 'Actions';
	echo '</th>';
	echo '</tr>';
	echo '</thead>';
	for ($i=0; $i < count($filter_data); $i++) { 
		$id = $filter_data[$i]['id'];
		echo '<tr>';
		echo '<td>';
		echo $filter_data[$i]['tname'];
		echo '</td>';
		echo '<td>';
		echo date('g:i a',strtotime($filter_data[$i]['stime']));
		echo '</td>';
		echo '<td>';
		echo date('g:i a',strtotime($filter_data[$i]['etime']));
		echo '</td>';
		echo '<td>';
		echo $filter_data[$i]['status'];
		echo '</td>';
		echo '<td>';
		echo date('d-m-y',strtotime($filter_data[$i]['date']));
		echo '</td>';
		echo '<td>';
		echo "<a style='pointer-events: initial;' href=../controller/student_taskComplete.php?t_id=$id><button>Complete</button></a>";
		echo '&nbsp;';
		echo "<a style='pointer-events: initial;' href=student_taskUpdate.php?t_id=$id><button>Update</button></a>";
		echo '&nbsp;';
		echo "<a style='pointer-events: initial;' href=../controller/student_taskDelete.php?t_id=$id><button style='background-color: indianred;'>Delete</button></a>";
		echo '&nbsp;';
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';

}
else{
	$result = getAllTaskData($id);
	if($result !== null){
		$data = $result->get_result();
		if($data->num_rows > 0){
			while($fdata = $data->fetch_assoc()){
				$filter_data[] = $fdata;
			}
		}
	}
	echo '<table>';
	echo '<thead>';
	echo '<tr>';
	echo '<th>';
	echo 'Title';
	echo '</th>';
	echo '<th>';
	echo 'Start Time';
	echo '</th>';
	echo '<th>';
	echo 'End Time';
	echo '</th>';
	echo '<th>';
	echo 'Status';
	echo '</th>';
	echo '<th>';
	echo 'Date';
	echo '</th>';
	echo '<th>';
	echo 'Actions';
	echo '</th>';
	echo '</tr>';
	echo '</thead>';
	for ($i=0; $i < count($filter_data); $i++) { 
		$id = $filter_data[$i]['id'];
		echo '<tr>';
		echo '<td>';
		echo $filter_data[$i]['tname'];
		echo '</td>';
		echo '<td>';
		echo date('g:i a',strtotime($filter_data[$i]['stime']));
		echo '</td>';
		echo '<td>';
		echo date('g:i a',strtotime($filter_data[$i]['etime']));
		echo '</td>';
		echo '<td>';
		echo $filter_data[$i]['status'];
		echo '</td>';
		echo '<td>';
		echo date('d-m-y',strtotime($filter_data[$i]['date']));
		echo '</td>';
		echo '<td>';
		echo "<a style='pointer-events: initial;' href=../controller/student_taskComplete.php?t_id=$id><button>Complete</button></a>";
		echo '&nbsp;';
		echo "<a style='pointer-events: initial;' href=student_taskUpdate.php?t_id=$id><button>Update</button></a>";
		echo '&nbsp;';
		echo "<a style='pointer-events: initial;' href=../controller/student_taskDelete.php?t_id=$id><button style='background-color: indianred;'>Delete</button></a>";
		echo '&nbsp;';
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
}