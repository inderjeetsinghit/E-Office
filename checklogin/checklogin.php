<?php
session_start();
define('include_config', TRUE);
include_once '../dbfiles/config.php';
if(isset ($_POST['log'])){
$myusername=$_POST['username']; 
$mypassword=$_POST['pass'];
$type=$_POST['type'];
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$mypassword= md5($mypassword);
$type=stripslashes($type);
class checklogin{
    private $username;
    private $password;
    private $type;
    function check_login($u, $p, $t){
        db_connect();
        $this->username= $u;
        $this->password= $p;
        $this->type= $t;
        
        //$con= pg_connect('host=localhost dbname=complaint user=postgres password=waheguru');
        $query="SELECT * FROM users WHERE user_name='$this->username' and password='$this->password' and type='$this->type' and pending='0'";
        
        $result=mysql_query($query);
        $rec= mysql_fetch_assoc($result);
        if(!$result){
            echo mysql_error();
        }
        $count=mysql_num_rows($result);
        //echo $count;
        if($count==1)
        {
            $check_new_message= mysql_query("Select count(auto_inc) as new_mesg from message_rec where from_read='1'");
            if(!$check_new_message){
                echo mysql_error();
            }
            $res= mysql_fetch_assoc($check_new_message);
            if($res!=0){
                $_SESSION['new_mes']= 'No New Message';
            }
            else{
                $_SESSION['new_mes']= $res['new_mesg'];
            }
            //echo $_SESSION['new_mes'];
            $_SESSION['username']=$this->username;
            $_SESSION['type']=$this->type;
            $_SESSION['dep']= $rec['dep_branch'];
            session_cache_expire(15);
            header("location:../home.php");
        }
        else
        {
            header("location:error.php");
        }
    }
}
$checklog= new checklogin();
$checklog->check_login($myusername, $mypassword, $type);
}
else{
    header('location:../nodirectaccess.html');
}
?>