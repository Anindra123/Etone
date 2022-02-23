<?php 
session_start();
$_SESSION['page_name'] = 'Delete Account Page';
$id = $_SESSION['id'] ?? '';
require_once 'header.php';
require_once 'dataAcess.php';
if(isset($_GET['submit'])){
	if($_GET['submit'] === "yes"){
		delete_account($id);
		header("Location: logout.php");
		exit();
	}
	else{
		header("Location: student_tasks.php");
		exit();
	}
}
?>

<form>
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
require_once 'footer.php';
?>  