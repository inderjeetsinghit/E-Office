<?php
session_start();
/* if(!session_is_registered(username)) {
  header("location:../../index.php");
  } //$session id */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define('include_diary_entry_class', TRUE);
include_once 'diary_entry.php';
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $new_entry= new diary_entry();
    $new_entry->entry($_POST['mode'], $_POST['lg'], $_POST['type'], $_POST['ld'], $_POST['rd'], $_POST['dd'], $_POST['rec_name'], $_POST['add'], $_POST['email'], $_POST['country'], $_POST['state'], $_POST['contact'], $_POST['department'], $_POST['category'], $_POST['sub']);
}
?>
