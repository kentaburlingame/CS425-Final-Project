<?php

if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

/* Database config */



$db_host	= 'kent@polahbeah.dyndns.org';
$db_user	= 'cs425';
$db_pass	= '19910351';
$db_database	= '425project'; 

/* End config */

$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');

mysql_select_db($db_database,$link);
mysql_query("SET names UTF8");
?>
