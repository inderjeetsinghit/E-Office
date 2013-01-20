<?php
define('include_user_lib', TRUE);
include_once 'user_lib.php';
$a= new app();
$mesg= $a->approve($_GET['id'], $_GET['app']);
header('location:viewuser.php?mes='.$mesg);
?>