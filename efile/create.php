<?php

/*
 *Calls add_efile_detail function of file_lib.php
 *
 */
if(isset ($_POST['makeefile'])){
    if($_POST['description']=='' || $_POST['categ']=='' ){
        $mesg= '<span class="error_mesg">Some Fields are left empty</span>';
        header('location:new.php?mesg='.$mesg);
    }
    else{
        define('include_file_lib', TRUE);
        include_once 'file_lib.php';
        $new_file_enter= new new_efile();
        $mesg= $new_file_enter->add_efile_detail($_POST['id'], $_POST['description'], $_POST['fileatt'], $_POST['categ'], $_SESSION['dep']);
        header('location:new.php?mesg='.$mesg);
    }
    
}
else{
    
}
?>
