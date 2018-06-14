<?php
$servername = "172.168.1.2";
$username = "root";
$password = "R00t@M!$";
$database = "";

try {
    $conn = new PDO("mysql:host=172.168.1.2;port=3306;dbname=hospital_dbo", "root", "R00t@M!$");
    // set the PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 

    $output = '';
		$query = "SELECT hpercode, patlast, patfirst, patmiddle FROM hperson WHERE patlast LIKE '%"."ramos"."%'";
	    $result = $conn->query($query);
	    $output = '<ul class="list-unstyled">';



		if ($result->rowCount() > 0){

		    while($row = $result->fetch(PDO::FETCH_ASSOC)){
		    	$output .= '<li>'.$row["patlast"].'</li>';
		    	
		    }
		}
		else{
			$output .= '<li>Patient not found</li>';
		}
		$output .= '</ul>';
		echo $output;

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>