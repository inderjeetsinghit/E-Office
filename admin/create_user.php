<?php
define('include_user_lib', TRUE);
include_once 'user_lib.php';
$new_user= new user_creation();
$message= $new_user->crea_user($_POST['newusername'], $_POST['newpassword'], $_POST['confirmpassword'], $_POST['type'], $_POST['dep'], $_POST['email']);
header('location:newuser.php?message='.$message);
?>
