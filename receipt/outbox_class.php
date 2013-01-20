<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of outbox_class
 *
 * @author inderjeet
 */
if(!defined('include_outbox_class')){header('location:../../nodirectaccess.html');}
include_once 'paginator.php';
define('include_config', TRUE);
include_once '../dbfiles/config.php';
class outbox_class {
    private $user;

    public function outbox_content($u) {
        db_connect();
        $this->user=$u;
        $query = "SELECT COUNT(*) FROM message_rec where `from`='$this->user'";
        $result = mysql_query($query) or die(mysql_error());
        $num_rows = mysql_fetch_row($result);
        //echo $num_rows;
        $pages = new Paginator;
        $pages->items_total = $num_rows[0];
        $pages->mid_range = 5; // Number of pages to display. Must be odd and > 3
        $pages->paginate();

        echo $pages->display_pages();
        echo "<span class=\"\" >" . $pages->display_jump_menu() . $pages->display_items_per_page() . "</span>";

        $query2 = "SELECT id, tag, due_date, date_enter, subject, auto_inc, type, `from`, `to` FROM message_rec where `from`='$this->user' ORDER BY auto_inc DESC $pages->limit";
        $result2 = mysql_query($query2) or die(mysql_error());
        $i=1;
        echo "<table cellspacing=0 width=95% align=center>";
        echo "<tr><th>Sr. No.</th><th>Priority</th><th>Number</th><th>Subject</th><th>Sender</th><th>Sent on</th><th>Due Date</th><th>Action</th></tr>";
        while ($row = mysql_fetch_array($result2)) {
            
            echo "<tr onmouseover=\"hilite(this)\" onmouseout=\"lowlite(this)\"><td>$i</td><td>&nbsp;</td><td>".'<a href=open_mesg.php?id='.$row[id].'&call_open=set>'."$row[id]/$row[tag]/$row[date_enter]</a></td><td>$row[subject]</td><td>$row[from]</td><td>$row[date_enter]</td><td>$row[due_date]</td><td>&nbsp;<img src='../images/icn_jump_back.png' title='Reply' />&nbsp; &nbsp;<img src='../images/icn_forward.png' title='Forward' />&nbsp; &nbsp;<img src='../images/icn_logout.png' title='Remove' /></td></tr>\n";
            $i= $i +1;
            
        }
        echo "</table>";

        echo $pages->display_pages();
        echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
        //echo "<p class=\"paginate\">SELECT * FROM table $pages->limit (retrieve records $pages->low-$pages->high from table - $pages->items_total item total / $pages->items_per_page items per page)";
    }
}

?>
