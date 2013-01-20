<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_POST['SendRep'])) {
    define('include_mesg_class', TRUE);
    include_once 'mesg_class.php';
    $new_mesg_rep = new new_mesg_class();
    $new_mesg_rep->set_id_reply($_POST['mesg_id']);
    $new_mesg_rep->new_mesg_rec($_POST['reply'], $_POST['to'], $_POST['priority'], $_POST['rec_num'], $_POST['remark'], $_POST['sub'], $_POST['due_date'], $_POST['action']);
} else {
    header('location:../nodirectaccess.html');
}
?>
