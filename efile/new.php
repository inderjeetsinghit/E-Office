<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(!session_cache_expire()){
    header("location:../index.php?mesg=expire");
}
if(!isset($_SESSION['username'])){
    $mesg= base64_encode('You are not logged in');
    header('location:../index.php?type=error&mesg='.$mesg);
}
define('include_file_lib', TRUE);
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title>E-Office</title>
        <script type="text/javascript" src="../js/footer.js"></script>
        <link rel="stylesheet" href="../css/layout.css" type="text/css" media="screen" />
        <script src="http://code.jquery.com/jquery-latest.js"></script>
       <script>
function countChecked() {
var file = new Array();
    jQuery("input[name='attachfile[]']:checked").each(function(){
        file.push(jQuery(this).val());
    });
    document.getElementById('fileatta').innerHTML= file;
    document.forms["file"]["fileatt"].value= file;
}
</script>
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
    .boxsizingBorder {
box-sizing: border-box;
-webkit-box-sizing:border-box;
-moz-box-sizing: border-box;
-ms-box-sizing: border-box;
}
</style>
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="../scripts/jquery.min.js"></script>
        <script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
                elements : "elm1",
		theme : "simple",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
        tinyMCE.init({
		// General options
		mode : "exact",
                elements : "elm2",
		theme : "advanced",
                
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

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
<script type="text/javascript" src="scroll.js"></script>
<script type="text/javascript">
	
</script>
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
                <p><?php echo $_SESSION['username']; ?>(<a href="inbox.php"><?php echo $_SESSION['new_mes']; ?></a>)</p>
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
            blockty('file');
            ?>

            <footer>
                <script type="text/javascript">footer();</script>
            </footer>
        </aside><!-- end of sidebar -->

        <section id="main" class="column">





            <article class="module width_3_quarter">
                <header><h3 class="tabs_involved">Create New E-File
                        

                    </h3>

                </header>
                <?php echo $_GET['mesg'];?>
                <div style="width:500px;"><br/>
                   <?php                                include_once 'file_lib.php';?>
                    <form method="POST" action="create.php" name="file">
                    <table>
                        <tr>
                            <td>ID</td>
                            <td><?php $new_id= new new_efile();
                            $newid= $new_id->initial_id();
                            echo $newid.'<input type="hidden" value="'.$newid.'" name="id" />';?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               Description
                            </td>
                            <td>
                                <textarea id="elm1" rows="1" cols="18" name="description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Category
                            </td>
                            <td>
                                <select name="categ">
                                    <option value="">Select one</option>
                                    <option value="academic">Academics</option>
                                    <option value="notice">Notice</option>
                                </select>
                               
                        </tr>
                        <tr>
                            <td>
                                Department
                            </td>
                            <td>&nbsp;<?php echo $_SESSION['dep'];?></td>
                        </tr>
                        <tr>
                            <td>File Attached</td>
                            <td><span id="fileatta">&nbsp; No File Attached</span><input type="hidden" name="fileatt" id="fileatt" value="No file Attached"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="makeefile" value="Create E-File"/></td>
                        </tr>
                    </table>
                    </form>

               
                   
                </div>
                <div></div>
            </article><!-- end of messages article -->
            <article class="module width_quarter">
                <header><h3 class="tabs_involved">Attach the Files
                        

                    </h3>

                </header>
                <div id="tab2" class="tab_content" style= "height:200px; overflow:auto;">
			<table class="tablesorter" cellspacing="0" id="myScrollTable"> 
			<thead> 
				<tr> 
   					
    				<th>Select</th> 
    				<th>Ref ID</th> 
    				<th>Created on</th> 
    				
				</tr> 
			</thead> 
			<tbody> 
				<?php 
                                $all_file= new new_efile();
                                $all_file->all_upload_file($_SESSION['username']);
                                ?>
				 
			</tbody> 
			</table>
                    <div id="show"></div>
			</div>
                <input type="button" value="Attach Files" onclick="countChecked();"/>
            </article>
            <div class="clear"></div>
		
            <article class="module width_full">
                <header><h3>Prepare noting</h3></header>
                <textarea id="elm2" style="width:100%" name="elm2" rows="10" cols="18"></textarea>
            </article>

            <div class="spacer"></div>
        </section>


    </body>

</html>

