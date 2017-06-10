<?
date_default_timezone_set("Asia/Bangkok");
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', 'database');
define('DB_DATABASE', 'esportsp_db');

$link = mysql_connect( DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
if(!$link) {
		die( "Could not connect server" );
}

$result=mysql_select_db(DB_DATABASE);
if ( !$result)  {
		die( "Could not open ".DB_DATABASE." database" );
}
$lang = "SET NAMES 'utf8' ";
mysql_query($lang) or die('Error query: ' . mysql_error());
?>
