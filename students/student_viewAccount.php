<?php 
session_start();
$_SESSION['page_name'] = "View Profile Page";
$id = $_SESSION['id'] ?? ""; 
if(isset($_SESSION['u_errors'])){
	unset($_SESSION['u_errors']);
}
if(isset($_SESSION['p_errors']) && isset($_SESSION['p_data'])){
	unset($_SESSION['p_errors']);
	unset($_SESSION['p_data']);
}
require_once 'DataAcess.php';
require_once 'dataAcessType.php';
require_once 'header.php';
set_type("f","students.json"); 
$data = get_studentAccData($id);

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
require_once 'footer.php';
?>

