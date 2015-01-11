<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set("Etc/GMT-9");

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','375032');
define('DBNAME','labbooksystem');

//application address
define('DIR','http://domain.com/');
define('SITEEMAIL','noreply@domain.com');


	//create mysqli connection 
	$db = new mysqli(DBHOST, DBUSER, DBPASS,DBNAME);
	
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//include the user class, pass in the database connection
include('classes/user.php');
$user = new User($db); 
?>
