<?php

session_start();
/*if(!session_is_registered(username)) {
    header("location:../index.php");
} //$session id*/
$path = "upload_dir/";
define('include_config', TRUE);
include_once '../dbfiles/config.php';
$valid_formats = array("jpg", "png", "gif", "bmp", "pdf");
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];

    if (strlen($name)) {
        list($txt, $ext) = explode(".", $name);
        if (in_array($ext, $valid_formats)) {
            $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
            $tmp = $_FILES['photoimg']['tmp_name'];
            if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                db_connect();
                $user= $_SESSION['username'];
                $comp_path= $path.$actual_image_name;
                $query= mysql_query("Insert into file_upload (path, user) values ('$comp_path', '$user')");
                echo 'File Uploaded. File Name is '.$actual_image_name.'<iframe src= upload_dir/' . $actual_image_name . ' style="width:98%; height:500px;"></iframe>';
            }
            else
                echo "failed";
        }
        else
            echo "Invalid file format..";
    }

    else
        echo "Please select image..!";

    exit;
}
?>