<?php
if(isset($_POST['change'])){
    define('include_user_lib', TRUE);
    include_once 'user_lib.php';
    $change= new self_reg();
    $mesg= $change->change_department_password($_POST['user_id'], "dep", $_POST['dep'], NULL);
    header('location:option.php?mesg='.$mesg);
}else{
    header('location:../nodirectaccess.html');
}

?>
