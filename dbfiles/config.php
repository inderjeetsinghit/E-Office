<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!defined('include_config')){header('location:../nodirectaccess.html');}
function db_connect() {
    $host= 'localhost';
    $user= 'root';
    $pass= 'waheguru';
    $db_name= 'eoffice';
    $con= mysql_connect($host, $user, $pass);
    $db= mysql_select_db($db_name);
}
function db_close(){
    mysql_close();
}
?>
