<?php
/*


$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);  */
    
 
// Database Connection variables
define('HOST', '172.168.1.2'); // Database host name ex. localhost
define('USER', 'root'); // Database user. ex. root ( if your on local server)
define('PASSWORD', 'R00t@M!$'); // Database user password  (if password is not set for user then keep it empty )
define('DATABASE', 'hospital_dbo'); // Database Database name 
define('PORT','3306'); // Database port number

/*
$servername = 'localhost';
$username = 'root';
$password = 'root';
$database='db_dis'; */



function DB()
{
    try {
        $db = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DATABASE.'', USER, PASSWORD);
        return $db;
    } catch (PDOException $e) {
        return "Connection failed due to: " . $e->getMessage();
        die();
    }
}




   
 
 

?>