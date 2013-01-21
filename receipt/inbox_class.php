<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inbox_class
 *
 * @author inderjeet
 */
if(!defined('include_inbox_class')){header('location:../../nodirectaccess.html');}
include_once 'paginator.php';
define('include_config', TRUE);
include_once '../dbfiles/config.php';
class inbox_class{

    private $user;

    public function inbox_content($u, $type) {
        db_connect();
        $this->user=$u;
        if($type=='user'){
            $query = "SELECT COUNT(*) FROM users where pending='1'";
        }
 elseif ($type=='file') {
          $query = "SELECT COUNT(*) FROM message_efile where `to`='$this->user'";  
        }
        else{
        $query = "SELECT COUNT(*) FROM message_rec where `to`='$this->user'";
        }
        $result = mysql_query($query) or die(mysql_error());
        $num_rows = mysql_fetch_row($result);
        //echo $num_rows;
        $pages = new Paginator;
        $pages->items_total = $num_rows[0];
        $pages->mid_range = 5; // Number of pages to display. Must be odd and > 3
        $pages->paginate();
        //echo $type;
        echo $pages->display_pages();
        echo "<span class=\"\" >" . $pages->display_jump_menu() . $pages->display_items_per_page() . "</span>";
        if($type=='user'){
            
        }
        else{
           $query1 = mysql_query("SELECT distinct id FROM message_rec where action='close'");
            $count= mysql_num_rows($query1);
            $list_array;
            $i=1; 
        }
        
        if($type=='rec'){
            
            //$list_array= array();
            while($note_id=  mysql_fetch_array($query1)){
                
                if($i!=$count){
                $list_array.= 'id!='."'".$note_id['id']."' and ";
                //echo $list_array;
                }
                else{
                    $list_array.= 'id!='."'".$note_id['id']."'";
                    //echo $list_array;
                }
                $i++;
            }
            
            $query2 = "SELECT * FROM message_rec where  $list_array and (`to`='$this->user' or `to`='all') ORDER BY auto_inc DESC $pages->limit";
        }
 elseif ($type=='closed') {
        $ultimate_user= $_SESSION['username'];
        $query2 = "SELECT * FROM message_rec where action='close' and `from`='$ultimate_user' ORDER BY auto_inc DESC $pages->limit";
 }
 elseif ($type=='user'){
        $query2= "Select * From users where pending='1'";
 }
 elseif($type=='deluser'){
     $query2= "Select * From users where pending='0'";
 }

        $result2 = mysql_query($query2) or die(mysql_error());
        $row_empty= mysql_num_rows($result2);
        $i=1;
        echo "<table cellspacing=0 width=95% align=center>";
        if($type=='user'){
            echo "<tr><th>Sr.No.</th><th>Username</th><th>Email</th><th>Department/Branch</th><th>Approve/Not</th></tr>";
        }
        elseif ($type=='deluser'){
            echo "<tr><th>Sr.No.</th><th>Username</th><th>Email</th><th>Department/Branch</th><th>Rank</th><th>Delete</th></tr>";
        }
        else{
        echo "<tr><th>Sr. No.</th><th>Priority</th><th>Number</th><th>Subject</th><th>Sender</th><th>Sent on</th><th>Due Date</th><th>Action</th></tr>";
        }
        while ($row = mysql_fetch_array($result2)) {
            if($type=='user' || $type=='deluser'){
                echo '<tr style="background-color:#ffffff;" onmouseover=\"hilite(this)\" onmouseout=\"lowlite(this)\">';
            }
            else{
            if($row['from_read']==1){
                echo '<tr style="background-color:#B1C8D8;" onmouseover=\"hilite(this)\" onmouseout=\"lowlite(this)\">';
            }  else {
                
                echo '<tr  onmouseover=\"hilite(this)\" onmouseout=\"lowlite(this)\">';
          
            }
            echo "<td>$i</td><td>&nbsp;</td><td>".'<a href=open_mesg?id='.$row[id].'&call_open=set&auto_id='.$row['auto_inc'].'>'."$row[id]/$row[tag]/$row[date_enter]</a></td><td>$row[subject]</td><td>$row[from]</td><td>$row[date_enter]</td><td>$row[due_date]</td><td>&nbsp;<img src='../images/icn_jump_back.png' title='Reply' />&nbsp; &nbsp;<img src='../images/icn_forward.png' title='Forward' />&nbsp; &nbsp;<img src='../images/icn_logout.png' title='Remove' /></td></tr>\n";
            $i= $i +1;
            
        }
        $j= $j +1;
        if($type=='user'){
            echo "<td>$j</td><td>$row[user_name]</td><td>$row[email]</td><td>$row[dep_branch]</td><td><a href=approve.php?id=".$row[id]."&app=yes>Yes</a>&nbsp;&nbsp;<a href=approve.php?id=".$row[id]."&app=no>No</a></td></tr>";
        }
        if($type=='deluser'){
            echo "<td>$j</td><td>$row[user_name]</td><td>$row[email]</td><td>$row[dep_branch]</td><td>$row[type] user</td><td><a href=deluser.php?id=".$row[id]."&user_name=".$row[user_name].">Delete</a></td></tr>";
        }
        if($row_empty==''){
            echo '<tr><td colspan="8" align="center">No Data Found for your query</td></tr>';
        }
        }
        echo "</table>";

        echo $pages->display_pages();
        echo "<p class=\"pagmesg_classinate\">Page: $pages->current_page of $pages->num_pages</p>\n";
        //echo "<p class=\"paginate\">SELECT * FROM table $pages->limit (retrieve records $pages->low-$pages->high from table - $pages->items_total item total / $pages->items_per_page items per page)";
    }

}

?>