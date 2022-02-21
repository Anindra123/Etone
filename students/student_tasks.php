<?php
	session_start();
	$_SESSION['page_name'] = 'Daily tasks page';

	require_once 'header.php'; 
	require_once 'dataAcess.php';
	require_once 'dataAcessType.php';
	set_type("f","student_taskData.json");
	$task_data = 
?>




<?php
	echo "Hello world";
	require_once 'footer.php';
?>