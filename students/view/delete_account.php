<?php 
session_start();
$_SESSION['page_name'] = 'Delete Account Page';
require_once 'header.php';
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
require_once 'footer.php';
?>  