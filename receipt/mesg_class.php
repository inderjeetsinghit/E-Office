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
if (!defined('include_mesg_class')) {
    header('location:../nodirectaccess.html');
}

class new_mesg_class {

    //put your code here
    private $mesg_rec_id;
    private $to;
    private $priority;
    private $rec_id;
    private $from;
    private $remarks;
    private $date_enter;
    private $subject;
    private $due_date; //@date to be entered
    private $action;
    private $type;

    public function set_id_reply($mesg_rec_id) {
        $this->mesg_rec_id = $mesg_rec_id;
        $this->type = 'reply';
    }

    public function new_mesg_rec($rep, $t, $p, $r, $re, $su, $due, $a) {
        db_connect();
        if ($this->type == 'reply') {
            $this->mesg_rec_id = explode('/', $this->mesg_rec_id);
            $new_id= $this->mesg_rec_id[0];
            $rep_tag= $this->mesg_rec_id[1];
            
        } else {
            $inital_mesg_rec_id = mysql_query("Select max(id) as max_rec_id from message_rec");
            $result = mysql_fetch_assoc($inital_mesg_rec_id);
            $this->mesg_rec_id = $result['max_rec_id'] + 1;
        }
        if($rep=='all'){
                $this->to = 'all';
            }
        else{
            $this->to = $t;
        }
        $this->priority = $p;
        $this->rec_id = $r;
        $this->from = $_SESSION['username'];
        $this->remarks = $re;
        $this->date_enter = date("Y-m-d");
        $this->subject = $su;
        $this->due_date = $due;
        $this->action = $a;
        if($this->type==reply){
            if($this->action=='close'){
              $query = mysql_query("Insert into message_rec (id, `to`, priority, rec_id, remarks, `from`, to_read, from_read, tag, date_enter, subject, due_date, type, action, closed) values ('$new_id', 'all', '$this->priority', '$this->rec_id', 'This thread is closed', '$this->from', '1', '1', '$rep_tag', '$this->date_enter', '$this->subject', '$this->due_date', 'reply', '$this->action', '1')");   
            }else{
                 $query = mysql_query("Insert into message_rec (id, `to`, priority, rec_id, remarks, `from`, to_read, from_read, tag, date_enter, subject, due_date, type, action) values ('$new_id', '$this->to', '$this->priority', '$this->rec_id', '$this->remarks', '$this->from', '1', '1', '$rep_tag', '$this->date_enter', '$this->subject', '$this->due_date', 'reply', '$this->action')");
            }
            
        }
        else{
        $query = mysql_query("Insert into message_rec (id, `to`, priority, rec_id, remarks, `from`, to_read, from_read, tag, date_enter, subject, due_date, type, action) values ('$this->mesg_rec_id', '$this->to', '$this->priority', '$this->rec_id', '$this->remarks', '$this->from', '1', '1', 'IT', '$this->date_enter', '$this->subject', '$this->due_date', 'new', '$this->action')");
        }
        if (!$query) {
            echo mysql_error();
            header('location:new_mesg.php?mesg=query_failed'.  mysql_error());
        } else {
            header('location:new_mesg.php?mesg=success');
        }
    }

}

class show_mesg {

    private $mesg_id;

    public function display_mesg($id) {
        db_connect();
        $this->mesg_id = $id;
        $auto_id= $_GET['auto_id'];
        $user= $_SESSION['username'];
        $mesg_open= mysql_query("Update message_rec set from_read='0' where auto_inc='$auto_id'");
        $query = mysql_query("Select * from message_rec where id='$this->mesg_id' and ((`to`='$user' or `from`='$user')or `to`='all') order by auto_inc asc");
        $upload_file= mysql_query("Select path from file_upload where id=(Select file_id from receipts where id=(Select id from receipts where id= (Select rec_id from message_rec where auto_inc=(Select max(auto_inc) from message_rec where id='$this->mesg_id'))))");
        $fetch_file= mysql_fetch_assoc($upload_file);
        if(!$upload_file){
            echo mysql_error();
        }
        else{
            //echo 'hi';
            //echo $fetch_file['path'];
        }
        //latest check for whether or not the thread is closed
        $latest_check_closed= mysql_fetch_assoc(mysql_query("Select max(auto_inc), action from message_rec where id='$this->mesg_id' "));
        if(!$latest_check_closed){
            echo mysql_error();
        }
        $diary_detail= mysql_query("Select * from receipts where id=(Select rec_id from message_rec where auto_inc=(Select max(auto_inc) from message_rec where id='$this->mesg_id'))");
        $fetch_diary_detail= mysql_fetch_assoc($diary_detail);
        $check_reply_exist= mysql_query("Select * from message_rec where id='$this->mesg_id' and type='reply'");
        if (!$query) {
            echo mysql_error();
        }
        $i = 1;
        $max_row = mysql_num_rows($query);
        $print_mesg='<article class="module width_3_quarter">
                <header><h3 class="tabs_involved">
                    </h3><br/></header>
                <div class="scroll">';
        $count_reply= mysql_num_rows($check_reply_exist);
        while ($records = mysql_fetch_array($query)) {
            if ($i == 1) {
                $print_mesg.= '<span style="font-family: Geneva, Tahoma, Verdana, sans-serif; font-size:13px; font-weight:bold;">' . $records['subject'] . '<span style="margin-left:250px;"><a href="reply.php"><img src="../images/print_icon.gif" height="20px" width="30px" title="Print Entire Conversation"/></a></span></span>';
                $print_mesg.= '<hr />';
            if($count_reply<1){
                if($records['to']!=$_SESSION['username']){
                continue;
                }   
            }
            $initial_creator= $records['from'];
            }
            
            $print_mesg.='<table width=100% cellspacing=0 cellpadding=0 >';
            
            $print_mesg.= '<td style="padding-left:20px;padding-top:10px;"><b>' . $records['from'] . '</b>&nbsp;to&nbsp;' . $records['to'] . '</td><td align="center"><b>Received on</b> &nbsp;' . $records['date_enter'] . '</td><td>';
            if($latest_check_closed['action']=='close'){
                $print_mesg.= '<img src="../images/mesg_rec_reply.png" height="20px" width="30px" title="Thread Closed. Cannot Reply To'.$records['from'].'"/></td>';
                $print_mesg.= '<td><img src="../images/mesg_rec_reply_all.png" height="20px" width="30px" title="Thread Closed. Cannot Reply To All"/></td>';
            }else{
            $print_mesg.= '<a href="new_mesg.php?id=' . $records['id'] . '&user_list=' . $records['from'] . '&type=reply&reply=single&creator='.$initial_creator.'"><img src="../images/mesg_rec_reply.png" height="20px" width="30px" title="Reply to '.$records['from'].'"/></a></td>';
            $print_mesg.= '<td><a href="new_mesg.php?id=' . $records['id'] . '&user_list=' . $records['from'] . '&type=reply&reply=all&creator='.$initial_creator.'"><img src="../images/mesg_rec_reply_all.png" height="20px" width="30px" title="Reply to All"/></a></td>';
            //$print_mesg.= '<td><a href="reply.php"><img src="../images/mesg_rec_forward.png" height="20px" width="30px" title="Forward Conversation"/></a></td>';
            }
            echo $latest_check_closed[1];
            $print_mesg.= '</td></tr></table><br/><br/>';
            $print_mesg.= '<hr class="style-four">';
            $print_mesg.= '<div style="padding:20px;">' . $records['remarks'] . '<br/><br/>';
            $print_mesg.= 'From<br/>' . $records['from'] . '</div>';
            if ($i < $max_row) {
                $print_mesg.= '<hr />';
            }
            $i++;
        }
        $print_mesg.='</div>
            </article>';
        $print_mesg.='<article class="module width_quarter">
                <header><h3 class="tabs_involved">
                    </h3><br/></header>
                <div id="listingpaginate" class="paginationstyle">
<a href="#" rel="previous" class="imglinks"><img src="http://img293.imageshack.us/img293/8643/roundleftig4.gif" /></a> <select></select> <a href="#" rel="next" class="imglinks"><img src="http://img183.imageshack.us/img183/3816/roundrightat5.gif" /></a>
</div>


<div class="virtualpage3 hidepiece">
<iframe src="'.$fetch_file['path'].'" width="100%" height="60%"frameborder="0"></iframe>
</div>

<div class="virtualpage3 hidepiece">
Uploaded File
</div>

<div class="virtualpage3 hidepiece">
<br/>
<table>
<tr><th colspan=4>Details of Receipt</th></tr><tr><td>'."&nbsp;".'</td></tr>
<tr>
                        <td>
                            Delivery Mode<span class="reqd">*</span>
                        </td>
                        <td>
                            '.$fetch_diary_detail['del_mode'].'
                        </td>
                        <td>
                            Language
                        </td>
                        <td>'.$fetch_diary_detail['lang'].'</td>
                    </tr>
                    <tr class="alter">
                        <th>
                            Type
                        </th>
                        <td>
                            '.$fetch_diary_detail['type'].'
                        </td>
                        <td>
                            Letter Date
                        </td>
                        <td>
                            <input type="text" name="ld" size="10" id="ledate" readonly="readonly" value="'.$fetch_diary_detail['letter_date'].'"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Received Date
                        </td>
                        <td>
                            <input type="text" name="rd" size="10" id="recdate" value="'.$fetch_diary_detail['rece_date'].'" readonly="readonly"/>
                        </td>
                        <td>
                            Diary Date
                        </td>
                        <td>
                            <input type="text" name="dd" size="10" id="diadate" value="'.$fetch_diary_detail['diary_date'].'" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr class="alter">
                        <td colspan="4">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr/></td>
                    </tr>
                    <tr>
                        <td>
                            Name <span class="reqd">*</span>
                        </td>
                        <td colspan="3">
                            <input type="text" id="name" name="rec_name" value="'.$fetch_diary_detail['name'].'" readonly="readonly" />
                        </td>
                    </tr>
                    <tr class="alter">
                        <td>
                            Address<span class="reqd">*</span>
                        </td>
                        <td colspan="3">
                            <textarea name="add" id="add" rows="3" cols="25" readonly="readonly">'.$fetch_diary_detail['address'].'</textarea>
                        </td>
                    
                    </tr>
                    <tr>
                        <td>
                            email<span class="reqd">*</span>
                        </td>
                        <td colspan="3">
                            <input type="text" id="email" name="email" value="'.$fetch_diary_detail['email'].'" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr class="alter">
                        <td>
                            Coumesg_classntry
                        </td>
                        <td>
                            '.$fetch_diary_detail['country'].'
                        </td>
                        <td>
                            State
                        </td>
                        <td>
                            '.$fetch_diary_detail['state'].'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact
                        </td>
                        <td>
                            <input type="text" name="contact" size="10"value="'.$fetch_diary_detail['contact'].'" readonly="readonly"/>
                        </td>
                        <td>
                            Department
                        </td>
                        <td>
                            '.$fetch_diary_detail['department'].'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr/></td>
                    </tr>
                    <tr>
                        <td>
                            Category<span class="reqd">*</span>
                        </td>
                        <td colspan="3">
                            '.$fetch_diary_detail['category'].'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Subject
                        </td>
                        <td colspan="3">
                            <textarea name="sub" rows="3" cols="25" readonly="readonly">'.$fetch_diary_detail['subject'].'</textarea>
                        </td>
                    </tr>
</table>
</div>


</div>
            </article>';
        echo $print_mesg;
    }

}

class mesg_rec_reply {

    private $id;
    private $to_send_list;
    private $val_array = array();

    public function mesg_reply($i_d, $send_list, $rep, $creator) {
        db_connect();
        $this->id = $i_d;
        $this->to_send_list = $send_list;
        $query = mysql_query("Select * from message_rec where id='$this->id'");
        if($rep=='single'){
            $rec = mysql_fetch_assoc($query);
            $this->val_array[intial_reply]= $creator;
            $this->val_array[sub] = $rec['subject'];
            $this->val_array[mesg_id] = $rec['id'] . '/' . $rec['tag'] . '/' . $rec['date_enter'];
            $this->val_array[file_id]= $rec['rec_id'];
            return $this->val_array;
        }
        
        while($rec=  mysql_fetch_array($query)){
            $this->val_array[intial_reply]= $rec['from'];
            $this->val_array[sub] = $rec['subject'];
            $this->val_array[mesg_id] = $rec['id'] . '/' . $rec['tag'] . '/' . $rec['date_enter'];
            $this->val_array[file_id]= $rec['rec_id'];
            return $this->val_array;
            break;
        }
        
    }

}

?>
