<?php 
session_start();
$_SESSION['page_name'] = "View Profile Page";
$id = $_SESSION['id'] ?? ""; 
$data = Null;
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}

if(!isset($_SESSION['u_data'])){
    header('Location: ../controller/viewStudentData.php');
    exit();
}
else{
    $data =$_SESSION['u_data'];
}
require_once 'includes/header.php';
?>
<h3>Your Profile</h3>

<div id="profileBox">
<img src="../../public/img/profile-icon.png" alt="profile icon" width="120" height="120">
<ul>
	<li><b>First Name :</b> <?php echo $data['fname'];?></li>
	<li><b>Middle Name :</b>  <?php echo $data['mname'];?></li>
	<li><b>Last Name :</b>  <?php echo $data['lname'];?></li>
	<li><b>Level of Education :</b>  <?php echo $data['loe'];?></li>
	<li><b>Institution Name :</b> <?php echo $data['ins_name'];?></li>
</ul>
</div>
<?php
require_once 'includes/footer.php';
?>

