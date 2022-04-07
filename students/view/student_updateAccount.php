<?php 
session_start();
$_SESSION['page_name'] = 'Update Account Info Page';
$data = [];
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

        <?php 
        
        $errors = $_SESSION['u_errors'] ?? [];
        if(isset($_SESSION['u_data'])){
            if(count($errors) === 0 && isset($_SESSION['success'])){
                echo '<br>';
                echo $_SESSION['success'];
                echo '<br><br>';
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['m_errors'])){
                echo '<br>';
                echo $_SESSION['m_errors'];
                echo '<br><br>';
                unset($_SESSION['m_errors']);
            }
        }
        ?>

<br><br> 
<form action="../controller/studentAcc_update_validation.php" method="post" onsubmit="return updateAccValidation(this)" novalidate>
   
    <fieldset>
        <legend>Your current information :</legend>
        <label for="fname">First Name *:</label>
        <br><br>
        <input type="text" name="fname"id="fname" autofocus 
        value= "<?php echo $data['fname'] ?? '';?>">
        <br>
        <span class="err fn"><?php echo $errors['fname_err'] ?? ''; ?></span>
        <br><br>
        <label for="mname">Middle Name:</label>
        <br>
        <input type="text" name="mname"id="mname" 
        value= "<?php echo $data['mname'] ?? '';?>">
        <br>
        <span class="err mn"><?php echo $errors['mname_err'] ?? ''; ?></span>
        <br><br>
        <label for="lname">Last Name *:</label>
        <br>
        <input type="text" name="lname" id="lname" 
        value= "<?php echo $data['lname'] ?? '';?>"> 
        <br>
        <span class="err ln"><?php echo $errors['lname_err'] ?? ''; ?></span>
        <br><br>    
        <label>Level of education * :</label>
        <br><br> 
        <input type="radio" name="loe" value="Elementary"
        id="elem">
        <label for="elem">Elementary(1-6)</label>
        <input type="radio" name="loe" value="Middle School"
        id="ms">
        <label for="ms">Middle School(5-9)</label>
        <input type="radio" name="loe" value="High School"
        id="hs">
        <label for="hs">High School(9-12)</label>
        <input type="radio" name="loe" value="College"
        id="clge">
        <label for="clge">College(University)</label>
        <br>
        <span class="err loe"><?php echo $errors['loe_err'] ?? ''; ?></span>
        <br><br>
        <label for="ins_name">Institution name :</label>
        <br><br>
        <input type="text" name="ins_name" id="ins_name" 
        value="<?php echo $data['ins_name'] ?? '';?>">
        <br><br>
        <input type="submit" value="Update">
        <br><br>
    </fieldset>
</form>
<br><br> 
<br><br>

<form action="delete_account.php">
    <fieldset style="text-align: center;">
        <legend>&#9940; Danger Zone &#9940;</legend>
        <br>
        <button style="background-color: indianred;" type="submit">Delete Account</button>
        <br><br>
    </fieldset>
</form>
<br><br>
<script src="scripts/updateAcc.js"></script>
<?php
require_once 'includes/footer.php';
if(isset($_SESSION['u_errors'])){
    unset($_SESSION['u_errors']);
}
// if(isset($_SESSION['u_data'])){
//     unset($_SESSION['u_data']);
// }
?>  