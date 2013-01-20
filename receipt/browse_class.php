<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inbox_class
 *
 * @author inderjeet
 */
include_once 'paginator.php';
define('include_config', TRUE);
include_once '../dbfiles/config.php';
class browse_class{

    private $user;
    private $tag;
    public function inbox_content($u) {
        db_connect();
        $this->tag= $_SESSION['dep'];
        $this->user=$u;
        $query = "SELECT COUNT(*) FROM receipts where `user`='$this->user'";
        $result = mysql_query($query) or die(mysql_error());
        $num_rows = mysql_fetch_row($result);
        //echo $num_rows;
        $pages = new Paginator;
        $pages->items_total = $num_rows[0];
        $pages->mid_range = 5; // Number of pages to display. Must be odd and > 3
        $pages->paginate();

        echo $pages->display_pages();
        echo "<span class=\"\" >" . $pages->display_jump_menu() . $pages->display_items_per_page() . "</span>";

        $query2 = "SELECT id, tag, diary_date, subject FROM receipts where tag='$this->tag' ORDER BY rece_date DESC $pages->limit";
        $result2 = mysql_query($query2) or die(mysql_error());

        echo "<table cellspacing=0 width=70% align=center>";
        echo "<tr><th>File Number</th><th>Subject</th><th>Actions</th></tr>";
        while ($row = mysql_fetch_array($result2)) {
           
            echo "<tr onmouseover=\"hilite(this)\" onmouseout=\"lowlite(this)\"><td>$row[0]/$row[1]/$row[2]</td><td>$row[3]</td><td>&nbsp;".'<a href=new_mesg.php?id='.$row[0].'/'.$row[1].'/'.$row[2].'&type=new>'."<img src='../images/email_send.png' title='Send Receipt' height='30' width='30' /> </a>&nbsp; &nbsp;<img src='../images/edit.png' title='Edit Receipt' height='25' width='25' />&nbsp; &nbsp;<a href='diaryentry/delete.php?id=".$row[0]."'><img src='../images/del.png' height='25' width='25' title='Remove Receipt' /></a></td></tr>\n";
        }
        echo "</table>";

        echo $pages->display_pages();
        echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
        //echo "<p class=\"paginate\">SELECT * FROM table $pages->limit (retrieve records $pages->low-$pages->high from table - $pages->items_total item total / $pages->items_per_page items per page)";
    }

}

?>
