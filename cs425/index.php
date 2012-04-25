<? 

define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

require 'header.php' 

?>
<div class="pageContent">
    <div id="main">
      <div class="container">
        <h1>Mega Movie Database</h1>
        <h2>Earn user points to gain rewards! </h2>
        </div>
        <div class="container">
		<h3><a href="">Discussion Forum</a></h3>
		<h3><a href="">Purcase Movie Tickets</a></h3>
          <div class="clear"></div>
        </div>
        
      <div class="container tutorial-info">    This is a tutorialzine demo. View the <a href="http://tutorialzine.com/2009/10/cool-login-system-php-jquery/" target="_blank">original tutorial</a>, or download the <a href="demo.zip">source files</a>.   
	      <p>Check out Theater X which is showing the most amount of movies right now!</p>
 </div>

    </div>
</div>

</body>
</html>
