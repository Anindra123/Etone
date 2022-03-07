<?php 
session_start();
$_SESSION['page_name'] = 'Delete Account Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
require_once 'includes/header.php';
?>

<form action="../controller/deleteStudentData.php" novalidate>
	<fieldset>
		<legend>Delete Confirmation :</legend>
		<br>
		<span><b>Confirm delete ? This will delete your account + information</b></span>
		<br><br>
		<button type="submit"  name="submit" value="yes" >Confirm delete</button>
		&nbsp;
		<button type="submit"  name="submit" value="no" >Cancel</button>
		<br><br>
	</fieldset>
	
</form>
<?php
require_once 'includes/footer.php';
?>  