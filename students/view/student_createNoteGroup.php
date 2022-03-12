<?php 
session_start();
$page_title = 'Create note group';
$_SESSION['page_name'] = 'Create Note Group Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$g_users = [];
if(!isset($_SESSION['u_data'])){
	header('Location: ../controller/viewStudentData.php');
	exit();
}
if(isset($_SESSION['u_data']) && !isset($_SESSION['g_users'])){
	$data =$_SESSION['u_data'];
	$g_users[] = array('id' => $data['id'], 'name' => $data['uname'],'mail' => $data['mail'],'role' =>$data['role'] );
	$_SESSION['g_users'] = $g_users;
}
$errors = $_SESSION['ng_errors'] ?? [];
$data = $_SESSION['ng_data'] ?? [];
require_once 'includes/header.php';

// var_dump($_SESSION['g_users']);
// exit();

require_once 'includes/noteGroupForm.php';

require_once 'includes/footer.php';

if(isset($_SESSION['ng_errors'])){
	unset($_SESSION['ng_errors']);
}
if(isset($_SESSION['ng_data'])){
	unset($_SESSION['ng_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['u_data'])){
	unset($_SESSION['u_data']);
}

// if(isset($_SESSION['g_users'])){
// 	unset($_SESSION['g_users']);
// }