<?php
session_start();
if(!session_cache_expire()){
    header("location:../index.php?mesg=expire");
}
if(!isset($_SESSION['username'])){
    $mesg= base64_encode('You are not logged in');
    header('location:../index.php?type=error&mesg='.$mesg);
}
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title>E-Office</title>
        <script type="text/javascript" src="../js/footer.js"></script>
        <link rel="stylesheet" href="../css/layout.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="paginator.css" type="text/css" media="screen" />
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
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





            <article class="module width_full">
                <header><h3 class="tabs_involved">Sent


                    </h3><br/>

                </header>
                Sent E-File Goes Here

            </article><!-- end of messages article -->


            <div class="spacer"></div>
        </section>


    </body>

</html>

