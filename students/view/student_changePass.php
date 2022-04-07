<?php 
session_start();
$_SESSION['page_name'] = 'Change Password Page';

if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$id = $_SESSION['id'] ?? ""; 
require_once 'includes/header.php';
?>
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
<br><br>
<form action="../controller/studentAcc_changePass_validation.php" method="post" onsubmit="return changePassValidation(this)" novalidate>
	<fieldset>
		<legend>Change Password :</legend>
		<br>
		<label for="pass">Old Password *:</label>
		<br><br>
		<input type="password" name="pass" id="pass" 
		value="<?php echo $data['pass'] ?? '';?>">
		<br>
		<span class="err ps"><?php echo $errors['pass_err'] ?? '';?></span>
		<br><br>
		<label for="npass">New Password *:</label>
		<br><br>
		<input type="password" name="npass" id="npass" 
		value="<?php echo $data['npass'] ?? '';?>">
		<br>
		<span class="err nps"><?php echo $errors['npass_err'] ?? '';?></span>
		<br><br>
		<label for="cpass">Confirm Password *:</label>
		<br><br>
		<input type="password" name="cpass" id="cpass" 
		value="<?php echo $data['cpass'] ?? '';?>">
		<br>
		<span class="err cps"><?php echo $errors['cpass_err'] ?? '';?></span>
		<br><br>
		<br>
		<input type="submit">
		<br><br>
	</fieldset>
</form>
<br><br>
<script src="scripts/changePass.js"></script>
<?php
require_once 'includes/footer.php';
if(isset($_SESSION['p_errors']) && isset($_SESSION['p_data'])){
	unset($_SESSION['p_errors']);
	unset($_SESSION['p_data']);
}
?>