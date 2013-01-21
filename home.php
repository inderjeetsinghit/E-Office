<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>E-Office</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
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
			<h1 class="site_title"><a href="index.html">Welcome <?php echo $_SESSION['username']; ?></a></h1>
			<h2 class="section_title">Dashboard</h2>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $_SESSION['username'];?> (<a href="receipt/inbox.php"><?php echo $_SESSION['new_mes']; ?></a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Receipt</h3>
            <ul class="toggle">
                <li class="icn_new_article"><a href="receipt/up_form.php">New Upload</a></li>
                <?php if($_SESSION['type']!='clerk'){?>
                <li class="icn_edit_article"><a href="receipt/browse.php">Browse Diaries</a></li>
                <li class="icn_categories"><a href="receipt/inbox.php">Inbox</a></li>
                <li class="icn_jump_back"><a href="receipt/outbox.php">Sent</a></li>
                <li class="icn_logout"><a href="receipt/closed.php">Closed</a></li>
            </ul>
            
            <h3>E-File</h3>
            <ul class="toggle">
                <li class="icn_folder"><a href="efile/inbox.php">Inbox</a></li>
                <li class="icn_new_article"><a href="efile/new.php">Create New</a></li>
                <li class="icn_jump_back"><a href="efile/sent.php">Sent</a></li>
                <li class="icn_logout"><a href="efile/closed.php">Closed</a></li>
            </ul>
            <?php } else { echo '</ul>';}?>
           <?php if ($_SESSION['type'] == 'admin') { ?>
         <h3>Users</h3>
            <ul class="toggle">
                <li class="icn_add_user"><a href="admin/newuser.php">Add New User</a></li>
                <li class="icn_view_users"><a href="admin/viewuser.php">View Users</a></li>
                <li class="icn_profile"><a href="admin/removeuser.php">Remove User</a></li>
                <li class="icn_settings"><a href="admin/option.php">Options</a></li>
                <li class="icn_security"><a href="admin/change.php">Change Password</a></li>
            </ul>
           <?php } ?>
            <h3>Other</h3>
            <ul class="toggle">
                
                <li class="icn_logout"><a href="checklogin/logout.php?log=logout">Logout</a></li>
            </ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 GNDEC, Ludhiana</strong></p>
			<p>Web App by <a href="http://www.gndec.ac.in" target="_blank">IT Department</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column"><br/><br/><br/><br/>
		<center>
                    
		<img src="images/eoffice.png" alt="EOffice" height="200" width="600" align="center"/>
                </center>
	</section>


</body>

</html>
