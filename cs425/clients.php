
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
//if($_SESSION['id']){
//	$manager = mysql_query("SELECT manager FROM agent WHERE usr='".$_SESSION['usr']."'");
//	$manager = mysql_fetch_row($manager);
//	$manager = $manager[0];
//}

$user_ID=$REQUEST['user_ID'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$password=$_REQUEST['password'];
$email_ID=$_REQUEST['email_ID'];
$streetNumber=$_REQUEST['streetNumber'];
$streetName=$_REQUEST['streetName'];
$aptNumber=$_REQUEST['aptNumber'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$zipCode=$_REQUEST['zipCode'];
$phoneNumber=$_REQUEST['phoneNumber'];
$type=$_REQUEST['type'];
$order=$_REQUEST['order'];

/* CREATES NEW CLIENT WHEN SUBMIT IS PRESSED */ 
if($type=="create" && !empty($user_ID) && !empty($firstname) && !empty($lastname) && !empty($password) && !empty($email_ID) && !empty($streetNumber) && !empty($streetName) && !empty($city) && !empty($state) && !empty(zipCode) && !empty(phoneNumber) ) {
	$made=true;
	$query = "INSERT INTO User(user_ID,firstname,lastname,password,email_ID,streetNumber,streetName,aptNumber,city,state,zipCode,phoneNumber) VALUES('$user_ID','$firstname','$lastname','$password','$email_ID','$streetNumber','$streetName', '$aptNumber', '$city', '$state', '$zipCode', '$phoneNumber')";
	mysql_query($query);
 }
 ?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml">
<head> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<title>Registered users only! | View Clients</title> 

<link rel="stylesheet" type="text/css" href="demo.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" /> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
<script src="login_panel/js/slide.js" type="text/javascript"></script> 

</head> 

<body> 

<div id="main"> 
    
    
    <?
	if($type=="create") {
	echo "<div class=\"container\">";
	if($made)
		echo "<h2>Created new client [$user_ID]</h2>";
	else
		echo "<h2>Failed to create new client due to missing information</h2>";
	echo "</div>";
	}
    ?>
   	<div class="container">
	<form action="./clients.php" method="Post">
    	<h1>New Client</h1>
	<fieldset>
		<div class="field>
			<label>User ID: </label>
			<input type="text" name="user_ID" class="text" value>
		</div>
		<div class="field">
			<label>First Name: </label>
			<input type="text" name="firstname"  class="text" value>
		</div>
		<div class="field">
			<label>Last Name: </label>
			<input type="text" name="lastname"  class="text" value>
		</div>
		<div class="field">
			<label>Password: </label>
			<input type="text" name="password"  class="text" value>
		</div>
		<div class="field">
			<label>Email: </label>
			<input type="text" name="email_ID" class="text" value>
		</div>
		<div class="field">
			<label>Street Number: </label>
			<input type="text" name="streetNumber"  class="text" value>
		</div>
		<div class="field">
			<label>Street Name: </label>
			<input type="text" name="streetName"  class="text" value>
		</div>
		<div class="field">
			<label>Apt Number: </label>
			<input type="text" name="aptNumber"  class="text" value>
		</div>
		<div class="field">
			<label>City: </label>
			<input type="text" name="city"  class="text" value>
		</div>
		<div class="field">
			<label>State: </label>
			<input type="text" name="state"  class="text" value>
		</div>
		<div class="field">
			<label>Zip Code: </label>
			<input type="text" name="zipCode"  class="text" value>
		</div>
		<div class="field">
			<label>Phone #: </label>
			<input type=text name="phoneNumber"  class="text" size=1 maxlength=12 value> (XXX-XXX-XXXX)
		</div>
		<label><input type=submit name="submit" id="r-submit" class="newbutton" value="Submit"></label>
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
	if(!empty($gender)) { $gender= " gender='".$gender."'";} else{ $gender=null;$gender=""; }

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
	</div> -->
  <div class="container tutorial-info">
  This is a tutorialzine demo. View the <a href="http://tutorialzine.com/2009/10/cool-login-system-php-jquery/" target="_blank">original tutorial</a>, or download the <a href="demo.zip">source files</a>.    </div>
</div>

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>Sunsational Vacations Employee Login</h1>
				<h2>Please login to access database</h2>		
				<p class="grey">Once logged in you will be able to access your client information.</p>
				<p class="grey">If you do not have an account yet please contact your manager.</p>
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
            
            <p>You can put member-only data here</p>
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
