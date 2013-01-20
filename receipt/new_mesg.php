<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}
if(!session_cache_expire()){
    header("location:../index.php?mesg=expire");
}
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title>E-Office</title>
        <script type="text/javascript" src="../js/footer.js"></script>
        <link rel="stylesheet" href="../css/layout.css" type="text/css" media="screen" />
       
        <style>
            table{
                margin: 10px;
                font-size: 13px;
            }
    .back_color{
        background-color: #BBBBBB;
    }
    textarea{
        resize:none;
    }
</style>
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="../scripts/jquery.min.js"></script>
        <script type="text/javascript" src="../scripts/jquery.form.js"></script>
       
        <script type="text/javascript" >
            $(document).ready(function() { 
		
                $('#photoimg').live('change', function()			{ 
                    $("#preview").html('');
                    $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
                    $("#imageform").ajaxForm({
                        target: '#preview'
                    }).submit();
		
                });
            }); 
        </script>
        <script type="text/javascript">
            function action_check(){
                //alert('Hello');
                var val= document.forms["mesg"]["action"];
                var to_field= document.forms["mesg"]["to"];
                var rem= document.forms["mesg"]["remark"];
                if(val.value=='close'){
                    to_field.value='Closed';
                    to_field.disabled=true;
                    rem.value= 'Thread is Closed';
                    rem.disabled= true;
                }
                else{
                    to_field.value= 'Fill to field';
                    to_field.disabled=false;
                    rem.value='';
                    rem.disabled= false;
                }
            }
            </script>
        <!-- Date Picker files -->
        <link rel="stylesheet" href="../css/jquery.ui.all.css" />

        <script type="text/javascript" src="../js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
<script type="text/javascript" src="../js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../js/jquery.ui.datepicker.js"></script>
        <script type="text/javascript">
            $(function() {
                $( "#duedate" ).datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
        <!--<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>-->
        <script src="../js/hideshow.js" type="text/javascript"></script>
        <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <script type="text/javascript">
            $(document).ready(function() 
            { 
                $(".tablesorter").tablesorter(); 
            } 
        );
            $(document).ready(function() {

                //When page loads...
                $(".tab_content").hide(); //Hide all content
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content

                //On Click Event
                $("ul.tabs li").click(function() {

                    $("ul.tabs li").removeClass("active"); //Remove any "active" class
                    $(this).addClass("active"); //Add "active" class to selected tab
                    $(".tab_content").hide(); //Hide all tab content

                    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                    $(activeTab).fadeIn(); //Fade in the active ID content
                    return false;
                });

            });
        </script>
        <script type="text/javascript">
            $(function(){
                $('.column').equalHeight();
            });
        </script>

    </head>


    <body>

        <header id="header">
            <hgroup>
                <h1 class="site_title"><a href="../home.php">Welcome <?php echo $_SESSION['username']; ?></a></h1>
                <h2 class="section_title">Dashboard</h2>
            </hgroup>
        </header> <!-- end of header bar -->

        <section id="secondary_bar">
             <div class="user">
                <p><?php echo $_SESSION['username']; ?>(<a href="../receipt/inbox.php"><?php echo $_SESSION['new_mes']; ?></a>)</p>
                <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
            </div>

        </section><!-- end of secondary bar -->

        <aside id="sidebar" class="column">
            <form class="quick_search">
                <input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
            </form>
            <hr/>
            <?php
            include_once '../js/menu.php';
            blockty('receipt');
            ?>

            <footer>
                <script type="text/javascript">footer();</script>
            </footer>
        </aside><!-- end of sidebar -->

        <section id="main" class="column">





            <article class="module width_3_quarter">
                <header><h3 class="tabs_involved">Send


                    </h3>

                </header>
                <div class="back_color"><br/>
                    <?php
                    if($_GET['type']=='reply'){
                        echo '<form method="post" action="mesg_reply.php" name="mesg">';
                    }
                    else{
                        echo '<form method="post" action="new_mesg_entry.php" name="mesg">';
                    }
                    ?>
                    
                <table  border="0" width="100%" cellpadding="5">
                    <?php echo '<tr><td colspan="2">';
 if($_GET['type']=='reply'){
     define('include_mesg_class', TRUE);
     include_once 'mesg_class.php';
     $reply_info= new mesg_rec_reply();
     $array_val= array();
     $array_val= $reply_info->mesg_reply($_GET['id'], $_GET['user_list'], $_GET['reply'], $_GET['creator']);
 }
                    if($_GET['mesg']=='query_failed'){
                        $_GET['mesg']= 'displayed';
                        echo '<span style="color:red">Sorry Query Failed</span>';
                        //echo '<span style="color:red">Dont Refersh Page!!!!</span>'; 
                    } 
 elseif ($_GET['mesg']=='success') {
              echo '<span style="color:green">Diary Entry made Successfully</span>'; 
              //echo '<span style="color:red">Dont Refersh Page After This!!!!</span>'; 
              
}  


    echo '</td></tr><tr>';
    if ($_GET['type']=='reply'){
        echo '<td>Receipt Number</td>';
        echo '<td><input type="hidden" name="mesg_id" value="'.$array_val[mesg_id].'" />'.$array_val[mesg_id].'</td>';
        echo '<tr><td>File Number To be Attached</td>';
        echo '<td><input type="hidden" name="rec_num" value="'.$array_val[file_id].'" />'.$array_val[file_id].'</td></tr>';
    }
 else {
        echo '<td>File Number To be Attached</td>';
        echo '<td><input type="hidden" name="rec_num" value="'.$_GET['id'].'" />'.$_GET['id'].'</td>';
    }
    echo '</tr>';
                    ?>
                    
                    <tr>
                        
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <?php if($_GET['type']=='reply'){
                            $check_rep= explode(':', $array_val[sub]);
                        if($check_rep[0]=='Re'){
                        echo '<td><input type="text" name="sub" value="'.$array_val[sub].'" readonly=readonly /></td>';}
                        else{
                            echo '<td><input type="text" name="sub" value="Re:'.$array_val[sub].'" readonly=readonly /></td>';
                        }
                        }
                        else{
                            echo '<td><input type="text" name="sub" value="" /></td>';
                        }
                        

                        ?>
                        
                    </tr>
                    <tr>
                        <td>
                            To:
                        </td>
                        <td><?php
                        if($_GET['type']=='reply'){ 
                            if($_GET['reply']=='single'){
                            echo '<input type="text" name="to" value="'.$_GET['user_list'].'"/>';}
                        else{
                            echo '<input type="text" name="to" value="all"/>';
                        }
                            
                        }
                        else{
    define('include_config', TRUE);
    include_once '../dbfiles/config.php';
    db_connect();
    $query= mysql_query("Select user_name from users");
    echo '<select name="to">';
    while($record= mysql_fetch_array($query)){
        echo '<option value="'.$record['user_name'].'">'.$record['user_name'].'</option>';
    }
    echo '</select>';
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>
                            CC:
                        </td>
                        <td><input type="text" name="cc"/></td>
                    </tr>
                    <tr>
                        <td>Set Due date</td>
                        <td><input type="text" name="due_date" id="duedate" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Action</td>
                        <td><select name="action" onchange=" return action_check();"><option value="forward">Forward</option>
                            <option value="callme">Call me</option>
                            <option value="approved">Approved</option>
                            <option value="pldiscuss">Pl.discuss</option>
                            <option value="givemetime">Give me Time</option>
                        <option value="fixmeet">Fix Meeting</option>
                        <option value="response">Response</option>
                         <?php
                                if($array_val[intial_reply]==$_SESSION['username']){
                                 echo' <option value="close">Close</option> ';
                                }
                                ?>
                            </select></td>
                    </tr>
                    <tr><td>
                            Priority
                        </td><td><select name="priority">
                                <option value="outtoday">Out Today</option>
                                <option value="mostimm">Most Immediate</option>
                                <option value="imm">Immediate</option>
                                <option value="ordinary">Ordinary</option>
                            </select></td></tr>
                    <tr>
                        <td>Remarks</td>
                        <td><textarea cols="25" name="remark" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="hidden" value="<?php echo $_GET['type'];?>"/></td>
                    </tr>
                    <?php
                    if($_GET['type']=='reply'){
                        echo '<tr><td colspan="2" align="center"><input type="submit" value="Send Reply" name="SendRep"/></td></tr>';
                    }
                    else{
                        echo '<tr><td colspan="2" align="center"><input type="submit" value="Send Message" name="SendMesg"/></td></tr>';
                    }
                    ?>
                    
                </table>
                </form>
                </div>
            </article><!-- end of messages article -->


            <div class="spacer"></div>
        </section>


    </body>

</html>

