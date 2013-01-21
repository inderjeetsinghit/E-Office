<?php

session_start();
if (!defined('include_user_lib')) {
    header('location:../nodirectaccess.html');
}
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
class user_creation {

    private $username;
    private $password;
    private $confpass;
    private $type;
    private $dep_branch;
    private $email;

    public function crea_user($u, $p, $cp, $ty, $d, $e) {
        $this->username = $u;
        $this->password = $p;
        $this->confpass = $cp;
        $this->type = $ty;
        $this->dep_branch = $d;
        $this->email = $e;

        if ($this->username == '' || $this->password == '' || $this->confpass = '' || $this->type == '' || ($this->password != $this->confpass) || $this->dep_branch == '' || $this->email == '') {
            return 'Error in form submission';
        } else {
            db_connect();
            $que = mysql_query("Select * from users where user_name='$this->username'");
            $count = mysql_num_rows($que);
            //return $count;
            if ($count == 1) {
                return '<span style="color:red;">Username Exist</span>' . $this->username;
            } else {
                //$md5_hash= stripslashes($this->username);
                //$md5_hash=md5($u);

                $query = mysql_query("Insert into users (user_name, password, type, dep_branch, email) values ('$this->username', md5('$this->password'), '$this->type', '$this->dep_branch', '$this->email')");
                if (!$query) {
                    echo mysql_error();
                } else {
                    return 'User Created Successfully';
                }
            }
        }
    }

}

class app {

    private $id;
    private $app;

    public function approve($i, $yn) {
        db_connect();
        $this->id = $i;
        $this->app = $yn;
        if ($this->app == 'yes') {
            $user_added = mysql_query("Update users set pending='0' where id='$this->id'");
            $get_detail = mysql_fetch_assoc(mysql_query("Select user_name, password from users where id='$this->id'"));
            if (!$get_detail) {
                echo mysql_error();
            } else {
                $subject = "Authentication Details";
                $message = "Hello! User. You'r Request had been approved. You'r credentials are<br/>";
                $message.='Username: ' . $get_detail['username'] . '</br>';
                $message.='Password: ' . $get_detail['username'] . '<br/>';
                $from = "no-reply@gndeceoffice.com";
                $headers = "From:" . $from;
                mail($to, $subject, $message, $headers);
            }
        } else {
            $user_added = mysql_query("Delete from users where id='$this->id'");
        }
        if (!$user_added) {
            echo mysql_error();
        } else {
            if ($this->app == 'yes') {
                return 'Username Approved';
            } else {
                return 'Username Deleted';
            }
        }
    }

    public function remove($id, $user) {
        $this->id = $id;
        db_connect();
        if ($user == "admin") {
            return base64_encode('Admin Can not be Deleted');
        } else {
            $del = mysql_query("Delete from users where id='$this->id'");
            if (!$del) {
                return mysql_error();
            } else {
                return base64_encode('User ' . $user . ' Deleted');
            }
        }
    }

}

class self_reg {

    private $email, $branch_dep;

    public function register($e, $d) {
        db_connect();
        $this->email = $e;
        $this->branch_dep = $d;
        $id = explode("@", $this->email);
        $query = mysql_query("Insert into users (user_name, password, type, dep_branch, email, pending) values ('$id[0]', md5('$id[0]'), 'normal', 'IT' , '$this->email', '1')");
        if (!$query) {
            echo mysql_error();
        } else {
            $subject = "Registration Application";
            $message = "Hello! User. You'r Request had been sent for approval. You will get your credentials after approval";
            $from = "no-reply@gndeceoffice.com";
            $headers = "From:" . $from;
            mail($to, $subject, $message, $headers);
            header('location:index.php?mesg=Request Sent. Please Check your mail for Response');
        }
    }

    public function change_department_password($user_id, $op, $value, $value2) {
        if ($op == "dep") {
            db_connect();
            $change_dep = mysql_query("Update users set dep_branch='$value' where id='$user_id'");
            if (!$change_dep) {
                $mesg = base64_encode(mysql_error());
                return $mesg;
            } else {
                $mesg = base64_encode("Department Successfully Changed");
                return $mesg;
            }
        } else if ($op == "pass") {
            db_connect();
            $check_previous_password = mysql_num_rows(mysql_query("Select id from users where user_name='$user_id' and password=md5('$value2')"));
            if ($check_previous_password == 1) {
                $change_pass = mysql_query("Update users set password= md5('$value') where user_name='$user_id'");
                if (!$change_pass) {
                    $mesg = base64_encode(mysql_error());
                    return $mesg;
                } else {
                    $mesg = base64_encode("Password Successfully Changed");
                    return $mesg;
                }
            } else {
                $mesg = base64_encode("Password Entered for account is incorrect");
                return $mesg;
            }
        }
        db_close();
    }

    public function get_user_list() {
        db_connect();
        $query = mysql_query("Select id, user_name from users");
        while ($row = mysql_fetch_array($query)) {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        }
    }

}

?>