<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  	<title>E-Office</title>
  	<meta name="description" content="Demo of a Sliding Login Panel using jQuery 1.3.2" />
  	<meta name="keywords" content="jquery, sliding, toggle, slideUp, slideDown, login, login form, register" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	

	<!-- stylesheets -->
  	<link rel="stylesheet" href="css/demo.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />

  	<!-- PNG FIX for IE6 -->
  	<!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
	<!--[if lte IE 6]>
		<script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>
	<![endif]-->

    <!-- jQuery - the core -->
	<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="js/slide.js" type="text/javascript"></script>

</head>

<body>
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>Welcome to E-Office</h1>
				<h2>From Paper to Paperless</h2>		
				<p class="grey">An Idea to make the process faster using E-Files to save time</p>
				<h2>Website</h2>
				<p class="grey">Guru Nanak Dev Engineering College<a href="http://www.gndec.ac.in" title="website">Website &raquo;</a></p>

			</div>
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="checklogin/checklogin.php" method="post">
					<h1>Member Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="username" id="log" value="" size="23" />
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="pass" id="pwd" size="23" />
					<label class="grey" for="type">Type:</label>
					<select id="ty" name="type">
					<option value="clerk">Clerk</option>
					<option value="normal">HOD'S & Heads</option>
					<option value="admin">Admin</option>
					</select>
	            	<!--<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>-->
        			<div class="clear"></div>
					<input type="submit" name="log" value="Login" class="bt_login" />
					<a class="lost-pwd" href="#">Lost your password?</a>
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form action="process_user_request.php" method="post">
					<h1>Not a member yet? Sign Up!</h1>				

					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					<label>A Username will be e-mailed to you.</label>
					<input type="submit" name="submit" value="Register" class="bt_register" />
				</form>
			</div>
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li>Hello Guest!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Log In | Register</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->

</div> <!--panel -->

    <div id="container">
		<div id="main">
      <div class="container">
        <h1>Welcome to E-Office</h1>
        <h2>From Paper to Paperless</h2>
        <center><img src= "images/eoffice.png" alt="E-Office" width="75%" height="75%"/></center>
        </div>
        
       
        
      <div class="container tutorial-info">
      Credits <a href="http://www.gndec.ac.in" target="_blank">Guru Nanak Dev Engineering College</a>    </div>
    </div>
<!-- / content -->		
	</div><!-- / container -->
</body>
</html>