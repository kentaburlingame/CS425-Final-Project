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

$name=$_REQUEST['name'];
$address=$_REQUEST['address'];
$phone=$_REQUEST['phone1']."-".$_REQUEST['phone2']."-".$_REQUEST['phone3'];
$city=$_REQUEST['city'];
$rating=$_REQUEST['rating'];
$type=$_REQUEST['type'];
$order=$_REQUEST['order'];

/* CREATES NEW RESORT WHEN SUBMIT IS PRESSED */ 
if($type=="create" && $name!=null && $address!=null && $phone!=null){ 
	$query = "INSERT INTO resort(name,address,phone,city_id,rating) VALUES('$name','$address','$phone','$city','$rating')"; mysql_query($query); } ?> 

<? require 'header.php'; ?>

<div id="main"> 
    
    
    <?
	if($_SESSION['id']) {
	if($type=="create") {
	echo "<div class=\"container\">";
	echo "<h2>Created new resort [$name, $address, $phone, $city, $rating]</h2>";
	echo "</div>";
	}
	if($manager==1) {
    ?>
   	<div class="container">
	<form action="./resorts.php" method="Post">
    	<h1>New Resort</h1>
	<fieldset>
		<div class="field">
			<label>Name: </label>
			<input type="text" name="name"  class="text" value>
		</div>
		<div class="field">
			<label>Address: </label>
			<input type="text" name="address" class="text" value>
		</div>
		<div class="field">
			<label>Phone #: </label>
			<input type=text name="phone1"  class="text" size=1 value>-
			<input type=text name="phone2" class="text" size=1 value>-
			<input type=text name="phone3" class="text" size=1 value>
		</div>
		<div class="field">
			<label>City: </label>
			<select name="city" class="text">
				<?
				$result = mysql_query("SELECT * FROM city") or die(mysql_error());
				while($row = mysql_fetch_array($result)) {
					echo "<option value=".$row[id].">".$row[name]."</option>\n";
				}
				?>
			</select>
		</div>
		<div>
			<label>Rating: </label>
			<select name="rating" id="r-rating" class="text">
				<option value="1">1 Sun</option>
				<option value="2">2 Suns</option>
				<option value="3">3 Suns</option>
			</select>
		</div>
		<label><input type=submit name="submit" id="r-submit" class="newbutton" value="Submit"></label>
		<input type="hidden" name="type" value="create">
	</fieldset>
	</form>
			
    </div>
	<? } ?>
	<div class="container">
	<h1>Search Resorts</h1>
	<form action="./resorts.php" method="GET">
	<fieldset>
		<div class="field">
			<label>Name: </label>
			<input type="text" name="name" class="text" value>
		</div>
		<div class="field">
			<label>City: </label>
			<select name="city" class="text">
				<option value=0>Any</option>
				<?
				$result = mysql_query("SELECT * FROM city") or die(mysql_error());
				while($row = mysql_fetch_array($result)) {
					echo "<option value=".$row[id].">".$row[name]."</option>\n";
				}
				?>
			</select>
		</div>
		<div class="field">
			<label>Rating: </label>
			<select name="rating" class="text">
				<option value="0">Any</option>
				<option value="1">1 Sun</option>
				<option value="2">2 Suns</option>
				<option value="3">3 Suns</option>
			</select>
		</div>
		<div class="field">
			<label>Order by: </label>
			<select name="order" class="text">
				<option value="resort.rating">Rating</option>
				<option value="resort.name">Name</option>
				<option value="city.name">City</option>
			</select>
		</div>
		<label><input type=submit name="submit" id="r-submit" class="newbutton" value="Submit"></label>
		<input type="hidden" name="type" value="search">
	</fieldset>
	</form>
	<?
	if($type=="search") {

	echo "[Name: ".$name.", City: ".$city.", Rating: ".$rating.", Order by: ".$order."]";
	
	/* QUERY VARIABLES*/
	if(!empty($name)) { $name = " resort.name LIKE '%".$name."%'"; } else{ $name=""; }
	if(!empty($city)) { $city = " resort.city_id='".$city."'";} else{ $city=""; }
	if(!empty($rating)) { $rating = " resort.rating='".$rating."'";} else{ $rating=""; }

	/*QUERY FOR SEARCH*/
	$query = "SELECT resort.name,resort.city_id,resort.rating,city.name,city.country FROM resort LEFT JOIN city ON resort.city_id=city.id ORDER BY ".$order;
	if(!empty($name) || !empty($city) || !empty($rating) ) {
		$query = "SELECT resort.name,resort.city_id,resort.rating,city.name,city.country FROM resort LEFT JOIN city ON resort.city_id=id WHERE".$name.$city.$rating." ORDER BY ".$order;
	}	
	$result = mysql_query($query);
	?>

	<fieldset>
	
	<? /* TABLE DISPLAYING SEARCH RESULTS */ ?> 
	<table class="search">
		<tr><th>Name</th><th>City</th><th>Country</th><th>Rating</th></tr>
		<? 
		$c=0;
		$avg=0;
		while($row = mysql_fetch_array($result)) {
			echo "<tr";
			if($c%2==0) { echo " style=\"background-color:#CCC;\""; }
			echo "><td class=\"name\">".$row[0]."</td><td class=\"loc\">".$row[3]."</td><td class=\"loc\">".$row[4]."</td><td class=\"rating\">".$row[2]."</td></tr>";
			$c++;
			$avg += $row[2];
		} ?>
	</table>
	</fieldset>	
	<fieldset>
	<? echo "Average rating of ".number_format($avg/$c,2)." Suns."; ?>
	</fieldset>
	<? } ?> 
	</div>
	<?}
	else echo '<h2>Please, <a href="index.php">login</a> and come back later!</h2>';
	?>
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
