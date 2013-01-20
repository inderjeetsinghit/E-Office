<?php

/*
 * Entry for New Mesg for Receipt forwarding.
 */
if (isset($_POST['SendMesg'])) {
    define('include_mesg_class', TRUE);
    include_once 'mesg_class.php';
    $new_mesg = new new_mesg_class();
    $new_mesg->new_mesg_rec('new', $_POST['to'], $_POST['priority'], $_POST['rec_num'], $_POST['remark'], $_POST['sub'], $_POST['due_date'], $_POST['action']);
} else {
    header('location:../nodirectaccess.html');
}
?>
