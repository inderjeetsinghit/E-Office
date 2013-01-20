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

        <link rel="stylesheet" href="../css/layout.css" type="text/css" media="screen" />
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <style type="text/css">
            .reqd{
                color:red;
                font-size: 18px;
            }

#error {
	color:red;
	font-size:10px;
	display:none;
}
.needsfilled {
	background:red;
	color:white;
}
</style>
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/validation.js"></script>

        <script type="text/javascript" src="../scripts/jquery.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.form.js"></script>
<style>
    .alter{
        background-color: #BBBBBB;
    }
    textarea{
        resize:none;
    }
</style>
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

        <!--<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>-->
        <script src="../js/hideshow.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/footer.js"></script>
        <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
<!-- Files for date picker -->
<link rel="stylesheet" href="../css/jquery.ui.all.css" />

        <script type="text/javascript" src="../js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
<script type="text/javascript" src="../js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../js/jquery.ui.datepicker.js"></script>
        <script type="text/javascript">
            $(function() {
                $( "#ledate" ).datepicker({dateFormat: 'yy-mm-dd'});
            });
            $(function() {
                $( "#diadate" ).datepicker({dateFormat: 'yy-mm-dd'});
            });
$(function() {
                $( "#recdate" ).datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
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
                <h2 class="section_title"></h2>
            </hgroup>
        </header> <!-- end of header bar -->

        <section id="secondary_bar">
            <div class="user">
                <p><?php echo $_SESSION['username']; ?>(<a href="../receipt/inbox.php"><?php echo $_SESSION['new_mes']; ?></a>)</p>
                <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
            </div>
            <div class="breadcrumbs_container">
                
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
                <header><h3 class="tabs_involved">Upload


                    </h3><br/>

                </header>

                <div class="tab_container">
                    <form id="imageform" method="post" enctype="multipart/form-data" action='upload_file.php'>
Upload your image <input type="file" name="photoimg" id="photoimg" />
</form>
                    <div id="preview">
                    <iframe src="upload_dir/demo.pdf" style="width: 100%; height:500px;" frameborder="0"></iframe>
                    </div>
                </div><!-- end of .tab_container -->

            </article><!-- end of content manager article -->

            <article class="module width_quarter">
                <header><h3>Diary Details</h3></header>
                <form id="theform" method="post" action="diaryentry/upload_rec.php">
                <table width="100%" cellpadding="5" cellspacing="0">
                    <?php echo '<tr><td colspan="4">';
                    if($_GET['mesg']=='query_failed'){
                        $_GET['mesg']= 'displayed';
                        echo '<span style="color:red">Sorry Query Failed</span>';
                        //echo '<span style="color:red">Dont Refersh Page!!!!</span>'; 
                    } 
 elseif ($_GET['mesg']=='success') {
              echo '<span style="color:green">Diary Entry made Successfully</span>'; 
              //echo '<span style="color:red">Dont Refersh Page After This!!!!</span>'; 
              
}  


    echo '</td></tr>';
                    ?>
                    <tr>
                        <td>
                            Delivery Mode<span class="reqd">*</span>
                        </td>
                        <td>
                            <select name="mode">
                                <option value="post">By Post</option>
                                <option value="email">By Email</option>
                                <option value="hand">By Hand</option>     
                            </select>
                        </td>
                        <td>
                            Language
                        </td>
                        <td><input type="text" name="lg" size="10"/></td>
                    </tr>
                    <tr class="alter">
                        <td>
                            Type
                        </td>
                        <td>
                            <select name="type">
                                <option value="circular">Circular</option>
                            </select>
                        </td>
                        <td>
                            Letter Date
                        </td>
                        <td>
                            <input type="text" name="ld" size="10" id="ledate" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Received Date
                        </td>
                        <td>
                            <input type="text" name="rd" size="10" id="recdate" readonly="readonly"/>
                        </td>
                        <td>
                            Diary Date
                        </td>
                        <td>
                            <input type="text" name="dd" size="10" id="diadate" readonly="readonly"/>
                        </td>
                    </tr>
                    <tr class="alter">
                        <td>
                            File Name
                        </td><td colspan="3">
                            <input type="text" name="fname" id="file_name" />
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
                            <input type="text" id="name" name="rec_name"/>
                        </td>
                    </tr>
                    <tr class="alter">
                        <td>
                            Address 1<span class="reqd">*</span>
                        </td>
                        <td colspan="3">
                            <textarea name="add" id="add" rows="3" cols="25"></textarea>
                        </td>
                    
                    </tr>
                    <tr>
                        <td>
                            email<span class="reqd">*</span>
                        </td>
                        <td colspan="3">
                            <input type="text" id="email" name="email"/>
                        </td>
                    </tr>
                    <tr class="alter">
                        <td>
                            Country
                        </td>
                        <td>
                            <select name="country">
                                <option value="India">India</option>
                            </select>
                        </td>
                        <td>
                            State
                        </td>
                        <td>
                            <select name=state>
<option value="Andaman and Nicobar Islands">A& N Islands</option>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadra and Nagar Haveli">D & N Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Orissa">Orissa</option>
<option value="Pondicherry">Pondicherry</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Tripura">Tripura</option>
<option value="Uttaranchal">Uttaranchal</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="West Bengal">West Bengal</option>
</select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact
                        </td>
                        <td>
                            <input type="text" name="contact" size="10"/>
                        </td>
                        <td>
                            Department
                        </td>
                        <td>
                            <select name="department">
                                <option value="IT">IT</option>
                                <option value="CSE">CSE</option>
                                <option value="PE">PE</option>
                                <option value="EE">EE</option>
                                <option value="ECE">ECE</option>
                                <option value="CE">CE</option>
                                <option value="ME">ME</option>
                                <option value="dean_welfare">Dean Welfare</option>
                                <option value="hostel_warden">Hostel Warden</option>
                            </select>
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
                            <select name="category">
                                <option value="A">A</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Subject
                        </td>
                        <td colspan="3">
                            <textarea name="sub" rows="3" cols="25"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center"><input type="submit" name="sub_rec" value="Generate Receipt"/></td>
                    </tr>
                </table>
            </form>
                

            </article><!-- end of messages article -->


            <div class="spacer"></div>
        </section>


    </body>

</html>

