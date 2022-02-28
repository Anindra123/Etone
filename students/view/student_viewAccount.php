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
}
else{
    $data =$_SESSION['u_data'];
}
require_once 'includes/header.php';
?>
<h3>Your account information :</h3>
<table border="1">
	<tr>
		<th>First Name :</th>
		<td><?php echo $data->fname;?></td>
	</tr>
	<tr>
		<th>Middle Name :</th>
		<td><?php echo $data->mname;?></td>
	</tr>
	<tr>
		<th>Last Name :</th>
		<td><?php echo $data->lname;?></td>
	</tr>
	<tr>
		<th>User Name :</th>
		<td><?php echo $data->uname;?></td>
	</tr>
	<tr>
		<th>Email :</th>
		<td><?php echo $data->mail;?></td>
	</tr>
	<tr>
		<th>Level of education :</th>
		<td><?php echo $data->loe;?></td>
	</tr>
	<tr>
		<th>Institution :</th>
		<td><?php echo $data->ins_name;?></td>
	</tr>

</table>

<?php
require_once 'includes/footer.php';
?>

