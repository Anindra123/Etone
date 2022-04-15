<?php 
session_start();
$_SESSION['page_name'] = 'Create Schedule Week Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
require_once 'includes/header.php';

?>
<br><br>
<form action="../controller/schedule_validation.php" method="post" onsubmit="return validateWeeklySchedule(this)" novalidate>
	<fieldset>
		<span>
			<?php 
			$data = $_SESSION['sw_data'] ?? [];
			$errors = $_SESSION['sw_errors'] ?? [];
			if(count($errors) === 0 && isset($_SESSION['success'])){
				echo '<br>';
				echo $_SESSION['success'];
				echo '<br><br>';
			}
			if(isset($_SESSION['m_errors'])){
				echo '<br>';
				echo $_SESSION['m_errors'];
				echo '<br><br>';
			}
			?>
		</span>
		<br>
		<legend>Create this week schedule :</legend>
		<label for="wname">Week name *:</label>
		<br><br>
		<input type="text" name="wname"id="wname" autofocus 
		value= "<?php echo $data['wname'] ?? '';?>">
		<br>
		<span class="err ws"><?php echo $errors['wname_err'] ?? ''; ?></span>
		<br>
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_scheduler.php" style="pointer-events:initial"><button type="button">Go back</button></a>
	<br>
</form>
<script src="scripts/weekSchedule.js"></script>
<?php
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}
if(isset($_SESSION['sw_data'])){
	unset($_SESSION['sw_data']);
}
if(isset($_SESSION['sw_errors'])){
	unset($_SESSION['sw_errors']);
}
require_once 'includes/footer.php';
?>
