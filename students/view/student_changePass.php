<?php 
session_start();
$_SESSION['page_name'] = 'Change Password Page';
$id = $_SESSION['id'] ?? ""; 

require_once 'header.php';
?>
<form action="../controller/studentAcc_changePass_validation.php" method="post" novalidate>
	<span>
		<?php 
		$errors = $_SESSION['p_errors'] ?? [];
		$data = $_SESSION['p_data'] ?? [];
		if(count($errors) === 0 && isset($_SESSION['success'])){
			echo '<br>';
			echo $_SESSION['success'];
			echo '<br><br>';
			unset($_SESSION['success']);
		}
		?>
	</span>
	<fieldset>
		<legend>Change Password :</legend>
		<br>
		<label for="pass">Old Password *:</label>
		<br><br>
		<input type="password" name="pass" id="pass" 
		value="<?php echo $data['pass'] ?? '';?>">
		<br>
		<span><?php echo $errors['pass_err'] ?? '';?></span>
		<br><br>
		<label for="npass">New Password *:</label>
		<br><br>
		<input type="password" name="npass" id="npass" 
		value="<?php echo $data['npass'] ?? '';?>">
		<br>
		<span><?php echo $errors['npass_err'] ?? '';?></span>
		<br><br>
		<label for="cpass">Confirm Password *:</label>
		<br><br>
		<input type="password" name="cpass" id="cpass" 
		value="<?php echo $data['cpass'] ?? '';?>">
		<br>
		<span><?php echo $errors['cpass_err'] ?? '';?></span>
		<br><br>
	</fieldset>
	<br>
	<input type="submit">
	<br><br>
</form>

<?php
require_once 'footer.php';
if(isset($_SESSION['p_errors']) && isset($_SESSION['p_data'])){
	unset($_SESSION['p_errors']);
	unset($_SESSION['p_data']);
}
?>