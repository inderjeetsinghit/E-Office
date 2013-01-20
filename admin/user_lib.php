<?php
session_start();
define('include_config', TRUE);
include_once '../dbfiles/config.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of new_mesg_class
 *
 * @author inderjeet
 */
if (!defined('include_user_lib')) {
    header('location:../nodirectaccess.html');
}
class user_creation{
    private $username;
    private $password;
    private $confpass;
    private $type;
    private $dep_branch;
    private  $email;
    public function crea_user($u, $p, $cp, $ty, $d, $e){
        $this->username= $u;
        $this->password= $p;
        $this->confpass= $cp;
        $this->type= $ty;
        $this->dep_branch= $d;
        $this->email= $e;
       
        if($this->username=='' || $this->password=='' || $this->confpass='' || $this->type=='' || ($this->password!=$this->confpass)||$this->dep_branch=='' ||$this->email==''){
            return 'Error in form submission';
        }
        else{
            db_connect();
            $que= mysql_query("Select * from users where user_name='$this->username'");
            $count= mysql_num_rows($que);
            //return $count;
            if($count==1){
                return '<span style="color:red;">Username Exist</span>'.$this->username;
            }
            else{
            //$md5_hash= stripslashes($this->username);
            //$md5_hash=md5($u);
            
            $query= mysql_query("Insert into users (user_name, password, type, dep_branch, email) values ('$this->username', md5('$this->password'), '$this->type', '$this->dep_branch', '$this->email')");
            if(!$query){
                echo mysql_error();
            }
            else{
                return 'User Created Successfully';
            }
        }
        }
    }
    
}
class app{
    private $id;
    private $app;
    public function approve($i, $yn){
        db_connect();
        $this->id=$i;
        $this->app= $yn;
        if($this->app=='yes'){
            $user_added= mysql_query("Update users set pending='0' where id='$this->id'");
            $get_detail= mysql_fetch_assoc(mysql_query("Select user_name, password from users where id='$this->id'"));
            if(!$get_detail){
               echo mysql_error();
            }
            else{
                $subject = "Authentication Details";
        $message = "Hello! User. You'r Request had been approved. You'r credentials are<br/>";
        $message.='Username: '.$get_detail['username'].'</br>';
        $message.='Password: '.$get_detail['username'].'<br/>';
        $from = "no-reply@gndeceoffice.com";
        $headers = "From:" . $from;
        mail($to,$subject,$message,$headers);
        
            }
        }
        else{
            $user_added= mysql_query("Delete from users where id='$this->id'");
        }
        if(!$user_added){
            echo mysql_error();
        }
        else{
            if($this->app=='yes'){
                return 'Username Approved';
            }
            else{
                return 'Username Deleted';
            }
        }
    }
    public function remove($id, $user){
        $this->id= $id;
        db_connect();
        $del= mysql_query("Delete from users where id='$this->id'");
        if(!$del){
            return mysql_error();
        }
        else{
            return 'User '.$user.' Deleted';
        }
    }
    
}
class self_reg{
    private $email;
    public function register($e){
        db_connect();
        $this->email= $e;
        $id= explode("@", $this->email);
        $query= mysql_query("Insert into users (user_name, password, type, pending, dep_branch, email) values ('$id[0]', md5('$id[0]'), 'normal', '1', 'IT', '$this->email')");
        if(!$query){
          echo mysql_error();
       }
        else{
        $subject = "Registration Application";
        $message = "Hello! User. You'r Request had been sent for approval. You will get your credentials after approval";
        $from = "no-reply@gndeceoffice.com";
        $headers = "From:" . $from;
        mail($to,$subject,$message,$headers);
       header('location:../index.php?mesg=Request Sent. Please Check your mail for Response');
        }
    }
}
?>