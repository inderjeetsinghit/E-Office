<?php
define('include_config', TRUE);
include_once 'dbfiles/config.php';
define('include_user_lib', TRUE);
include_once 'admin/user_lib.php';
$new_user= new self_reg();
$new_user->register($_POST['email']);
?>