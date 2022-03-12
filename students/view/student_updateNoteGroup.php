<?php 
session_start();
$page_title = 'Update note group';
$_SESSION['page_name'] = 'Update Note Group Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
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

if(!isset($_SESSION['ngu_data'])){
	$data =(array) getData() ?? [];
	$_SESSION['ngu_data'] = $data;
}
else{
	$data = $_SESSION['ngu_data'];
}
$errors = $_SESSION['ng_errors'] ?? [];
$note_viewers = [];
for ($i=0; $i < count($data['note_viewers']); $i++) { 
	$note_viewers[] =(array) $data['note_viewers'][$i];
}
if(!isset($_SESSION['g_users'])){
	$_SESSION['g_users'] = $note_viewers;
}

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
