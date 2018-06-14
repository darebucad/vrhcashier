<?php


// Start Session
session_start();

// Database connection
require_once('../config/connection.php');
$db = DB();

// Application library ( with Library class )
require_once('../functions/library.php');
$lib = new Library();


// check Login request

	if(isset($_POST["query"])){

		$db = DB();
        $output = '';
        $query = "SELECT hpercode, patlast, patfirst, patmiddle FROM hperson WHERE patlast LIKE '%". $_POST["query"] ."%' LIMIT 0,20";
        $result = $db->query($query);
        $output = '<ul class="list-unstyled" id="patname-ul">';

        if ($result->rowCount() > 0){

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $output .= '<li id="patname-li">'.$row["patlast"].', '.$row["patfirst"].'</li>';

        }

        }
        else{
            $output .= '<li id="patname-li">Patient not found</li>';
            $output .= '<li id="patname-li>Create Patient</li>';
        }
        $output .= '</ul>';
        echo $output;

	}
?>