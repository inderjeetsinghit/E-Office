<?php
define('include_user_lib', TRUE);
include_once 'user_lib.php';
$a= new app();
$mesg= $a->remove($_GET['id'], $_GET['user_name']);
header('location:removeuser.php?mes='.$mesg);
?>