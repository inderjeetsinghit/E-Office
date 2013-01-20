<?php
if($_GET['log']=="logout"){
session_start();
unset($_SESSION['username']);
unset($_SESSION['type']);
unset($_SESSION['dep']);
session_destroy();
header("location: ../index.php");
}
else{
    echo 'Permission Denied';
}
?>