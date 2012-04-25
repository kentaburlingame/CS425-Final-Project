

<?php
define('INCLUDE_CHECK',true);

require "connect.php";
require "functions.php";

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

if($_SESSION['id']){
	$manager = mysql_query("SELECT manager FROM agent WHERE usr='".$_SESSION['usr']."'");
	$manager = mysql_fetch_row($manager);
	$manager = $manager[0];
}

$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone1']."-".$_REQUEST['phone2']."-".$_REQUEST['phone3'];
$dob=$_REQUEST['dob'];
$zip=$_REQUEST['zip'];
$gender=$_REQUEST['gender'];
$type=$_REQUEST['type'];
$order=$_REQUEST['order'];

/* CREATES NEW CLIENT WHEN SUBMIT IS PRESSED */ 
if($type=="create" && !empty($fname) && !empty($lname) && !empty($email) && !empty($phone) && !empty($dob) && !empty($zip) && !empty($gender) ) {

	$made=true;
	$query = "INSERT INTO city(phone,email,fname,lname,dob,zip,gender) VALUES('$phone','$email','$fname','$lname','$dob','$zip','$gender')";
	mysql_query($query);
 }
 ?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml">
<head> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<title>Registered users only!</title> 

<link rel="stylesheet" type="text/css" href="demo.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" /> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
<script src="login_panel/js/slide.js" type="text/javascript"></script> 

</head> 

<body> 

<div id="main"> 
    
    
    <?
	if($_SESSION['id']) {
	if($type=="create") {
	echo "<div class=\"container\">";
	if($made)
		echo "<h2>Created new client [$lname, $fname, $email, $phone, $dob, $zip, $gender]</h2>";
	else
		echo "<h2>Failed to create new client due to missing information</h2>";
	echo "</div>";
	}
    ?>
   	<div class="container">
	<form action="./clients.php" method="Post">
    	<h1>Profile</h1>
	<fieldset>
		<div class="field">
			<label>First Name: </label>			
			<input type="text" name="fname"  class="text" value>
		</div>
		<div class="field">
			<label>Last Name: </label>
			<input type="text" name="lname"  class="text" value>

		</div>
		<div class="field">
			<label>Email: </label>
			<input type="text" name="email" class="text" value>
		</div>
		<div class="field">
			<label>Phone #: </label>
			<input type=text name="phone1"  class="text" size=1 maxlength=4 value>-
			<input type=text name="phone2" class="text" size=1 maxlength=3 value>-
			<input type=text name="phone3" class="text" size=1 maxlength=4 value>
		</div>
		<div class="field">
			<label>Date of Birth: </label>
			<input type=text name="dob" class="text" size=2 maxlength=10 value> (MM/DD/YYYY)
		</div>
		<div class="field">
			<label>Zip: </label>
			<input type="text" name="zip" class="text" value>
		</div>
		<div>
			<label>Gender: </label>
			<select name="gender" class="text">
				<option value="M">Male</option>
				<option value="F">Female</option>
			</select>
		</div>
		<label><input type=submit name="submit" id="r-submit" class="newbutton" value="Submit Changes"></label>
		<input type="hidden" name="type" value="create">
	</fieldset>
	</form>
			
    </div>


<!--	<div class="container">
	<h1>Search Clients</h1>
	<form action="./clients.php" method="GET">
	<fieldset>
		<div class="field">
			<label>First Name: </label>
			<input type="text" name="fname"  class="text" value>
		</div>
		<div class="field">
			<label>Last Name: </label>
			<input type="text" name="lname"  class="text" value>
		</div>
		<div class="field">
			<label>Date of Birth: </label>
			<input type=text name="dob" class="text" size=2 maxlength=10 value> (MM/DD/YYYY)
		</div>
		<div class="field">
			<label>Zip: </label>
			<input type="text" name="zip" class="text" value>
		</div>
		<div>
			<label>Gender: </label>
			<select name="gender" class="text">
				<option value=0>Either</option>
				<option value="M">Male</option>
				<option value="F">Female</option>
			</select>
		</div>
		<div>
			<label>Order: </label>
			<select name="order" class="text">
				<option value="fname">First</option>
				<option value="lname">Last</option>
				<option value="dob">Date of Birth</option>
			</select>
		</div>
		<label><input type=submit name="submit" id="r-submit" class="newbutton" value="Submit"></label>
		<input type="hidden" name="type" value="search"><div class="field">
	</fieldset>
	</form>
	<?
	if($type=="search") {

	echo "<div>[fName: ".$fname.", lName: ".$lname.", DoB: ".$dob.", Zip: ".$Zip.", Gender: ".$gender.", Order by: ".$order."]</div>";
	
	/* QUERY VARIABLES*/
	if(!empty($fname)) { $fname = " fname LIKE '%".$fname."%'"; } else{ $fname=""; }
	if(!empty($lname)) { $lname = " lname LIKE '%".$lname."%'"; } else{ $lname=""; }
	if(!empty($dob)) { $dob= " dob='".$dob."'";} else{ $dob=""; }
	if(!empty($zip)) { $zip= " zip='".$zip."'";} else{ $zip=""; }

	/*QUERY FOR SEARCH*/
	$query = "SELECT fname,lname,dob,zip,gender,id FROM client ORDER BY ".$order;
	if(!empty($fname) || !empty($lname) || !empty($dob) || !empty($zip) || !empty($gender) ) {
		$query = "SELECT fname,lname,dob,zip,gender,id FROM client WHERE".$fname.$lname.$dob.$zip.$gender." ORDER BY ".$order;
	}	
	$result = mysql_query($query);
	?>

	<fieldset>
	
	<? /* TABLE DISPLAYING SEARCH RESULTS */ ?> 
	<table class="search">
		<tr><th>Name</th><th>Date of Birth</th><th>Zip Code</th><th>Bookings Made</th><th>Gender</th></tr>
		<? 
		$c=0;
		while($row = mysql_fetch_array($result)) {

			$bookings = mysql_query("SELECT * FROM booking WHERE client_id='".$row[5]."'"); 
			$bookings = mysql_num_rows($bookings);

			echo "<tr";
			if($c%2==0) { echo " style=\"background-color:#CCC;\""; }
			echo "><td class=\"name\">".$row[1].", ".$row[0]."  <a href=\"./client.php?id={$row[5]}\">edit</a></td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$bookings."</td><td>".$row[4]."</td></tr>";
			$c++;
		} ?>
	</table>
	</fieldset>	
	<fieldset>
	<? echo "Search returned ".$c." results."; ?>
	</fieldset>
	<? } ?> 
	</div>
	<?}
	else echo '<h2>Please, <a href="index.php">login</a> and come back later!</h2>';
	?>-->
  <div class="container tutorial-info">
  This is a tutorialzine demo. View the <a href="http://tutorialzine.com/2009/10/cool-login-system-php-jquery/" target="_blank">original tutorial</a>, or download the <a href="demo.zip">source files</a>.    </div>
<!--</div>-->

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1><a href="employeeLogin">Employee Login</a></h1>
				<!--<h2>Please login to access database</h2>-->		
				<p class="grey">Once logged in you will be able to edit your profile, add to discussion forums and view your user credits and rewards.</p>
				<!--<p class="grey">If you do not have an account yet please contact your manager.</p>-->
			</div>
            
            
            <?php
			
			if(!$_SESSION['id']):
			
			?>
            
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="" method="post">
					<h1>Agent Login</h1>
                    
                    <?php
						
						if($_SESSION['msg']['login-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
	            	<label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
            
            <h1>Members panel</h1>
            
            <p>You have (blank) user credits.</p>
	    <p>Which means you have (blank) rewards.</p>
            <a href="registered.php">View a special member page</a>
            <p>- or -</p>
            <a href="?logoff">Log off</a>
            
            </div>
            
            <div class="left right">
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello <?php echo $_SESSION['usr'] ? $_SESSION['usr'] : 'Guest';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#"><?php echo $_SESSION['id']?'Open Panel':'Log In | Register';?></a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

</body>
</html>
