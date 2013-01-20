<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of file_lib
 *
 * @author inderjeet
 */
if (!defined('include_file_lib')) {
    header('location:../nodirectaccess.html');
}
define('include_config', TRUE);
include_once '../dbfiles/config.php';
class new_efile{
    private $query;
    public function initial_id() {
        db_connect();
        $this->query= mysql_fetch_assoc(mysql_query("Select id from file where auto_inc=(Select max(auto_inc) from file)"));
        $id= explode('/', $this->query);
        $comp_id= ($id[0]+1).'/'.$_SESSION['dep'].'/'.date('Y-m-d');
        return ($comp_id);
    }
    public function all_upload_file($user) {
        db_connect();
        $this->query= mysql_query("Select * from file_upload where user='$user'");
        if(!$this->query){
            echo mysql_error();
        }
        else{
            $all_file='';
            while($row= mysql_fetch_array($this->query)){
                $all_file.='<tr> 
   					<td><input type="checkbox" name="attachfile[]" class="attachfile" value="'.$row['id'].'/'.$_SESSION['dep'].'/'.$row['date'].'"></td> 
    				<td>'.$row['id'].'/'.$_SESSION['dep'].'/'.$row['date'].'</td> 
    				<td>'.$row['date'].'</td> 
                                
    				</tr> ';
            }
            echo $all_file;
        }
    }
    public function add_efile_detail($id, $description, $file_attach, $category, $dep) {
        db_connect();
        $query= mysql_query("Insert into file (id, description, file_attach, category, dep) values('$id', '$description', '$file_attach', '$category', '$dep')");
        if(!$query){
            $mesg= base64_encode(mysql_error());
            return $mesg;
        }
        else{
            $mesg= '<span class="mesg_success">E-File Created Successfully</span>';
            return $mesg;
        }
        
    }
    public function send_efile() {
       
        
    }
}

?>
