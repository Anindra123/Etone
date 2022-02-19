<?php 
session_start();
$_SESSION['page_name'] = 'Update Account Info Page';
require_once 'header.php';
require_once 'dataAcess.php';
if(isset($_SESSION['p_errors']) && isset($_SESSION['p_data'])){
    unset($_SESSION['p_errors']);
    unset($_SESSION['p_data']);
}
?>
<form action="studentAcc_update_validation.php" method="post" novalidate>
    <span>
        <?php 
        
        $errors = $_SESSION['u_errors'] ?? [];
        $id = $_SESSION['id'] ?? '';
        $data =(array) get_studentAccData($id) ?? [];
        if(count($errors) === 0 && isset($_SESSION['success'])){
            echo '<br>';
            echo $_SESSION['success'];
            echo '<br><br>';
            unset($_SESSION['success']);
        }
        ?>
    </span>
    <fieldset>
        <legend>Your current information :</legend>
        <label for="fname">First Name *:</label>
        <br><br>
        <input type="text" name="fname"id="fname" autofocus 
        value= "<?php echo $data['fname'] ?? '';?>">
        <br>
        <span><?php echo $errors['fname_err'] ?? ''; ?></span>
        <br><br>
        <label for="mname">Middle Name:</label>
        <br>
        <input type="text" name="mname"id="mname" 
        value= "<?php echo $data['mname'] ?? '';?>">
        <br>
        <span><?php echo $errors['mname_err'] ?? ''; ?></span>
        <br><br>
        <label for="lname">Last Name *:</label>
        <br>
        <input type="text" name="lname" id="lname" 
        value= "<?php echo $data['lname'] ?? '';?>"> 
        <br>
        <span><?php echo $errors['lname_err'] ?? ''; ?></span>
        <br><br>    
        <label>Level of education * :</label>
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
        <span><?php echo $errors['loe_err'] ?? ''; ?></span>
        <br><br>
        <label for="ins_name">Institution name :</label>
        <br><br>
        <input type="text" name="ins_name" id="ins_name" 
        value="<?php echo $data['ins_name'] ?? '';?>">
        <!-- <br>
        <span><?php //echo $errors['ins_name_err'] ?? ''; ?></span>
        <br><br>
        <label for="uname">Username *:</label>
        <br><br>
        <input type="text" name="uname"id="uname" 
        value="<?php //echo $data['uname'] ?? '';?>">
        <br>
        <span><?php //echo $errors['uname_err'] ?? ''; ?></span>
        <br><br>
        <label for="mail">Email *:</label>
        <br><br>
        <input type="text" name="mail"id="mail" 
        value="<?php// echo $data['mail'] ?? '';?>">
        <br>
        <span><?php //echo $errors['mail_err'] ?? ''; ?></span>
        <br> -->
    </fieldset>
    <br>
        <button type="submit">Update</button>
        <br><br>
</form>

<?php
    require_once 'footer.php';
?>