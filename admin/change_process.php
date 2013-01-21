<?php
if(isset($_POST['change_pro'])){
    define('include_user_lib', TRUE);
    include_once 'user_lib.php';
    $curr_user= $_SESSION['username'];
    $change= new self_reg();
    $mesg= $change->change_department_password($curr_user, "pass", $_POST['newpassword'], $_POST['oldpass']);
    header('location:change.php?mesg='.$mesg);
}else{
    header('location:../nodirectaccess.html');
}
?>
