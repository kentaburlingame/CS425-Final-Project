<?php

define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

$script = '
	<script type="text/javascript">
	
		$(function(){
		
			$("div#panel").show();
			$("#toggle a").toggle();
		});
	
	</script>';
	

	if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php");
	exit;
}

require 'header.php';

?>

<div id="main">
  
    
    <div class="container">
    
    <?php
	if($_SESSION['id'])
	echo '<h2>Hello, '.$_SESSION['usr'].'! You are registered and logged in!</h2>';
	else header("Location: index.php");
    ?>
    </div>
   	<div class="container">
    	<h1>Registered Users Only!</h1>
	<a href="./bookings.php">View/Edit Bookings</a><br/>
	<a href="./clients.php">View/Edit Clients</a><br/>
	<a href="./resorts.php">View/Edit Resorts</a><br/>
	<a href="./activities.php">View/Edit Activities</a><br/>
	<a href="./amenities.php">View/Edit Amenities</a><br/>
	<a href="./cities.php">View/Edit Cities</a><br/>
    </div>
  <div class="container tutorial-info">
  This is a tutorialzine demo. View the <a href="http://tutorialzine.com/2009/10/cool-login-system-php-jquery/" target="_blank">original tutorial</a>, or download the <a href="demo.zip">source files</a>.    </div>
</div>

<!-- Panel -->

</body>
</html>
