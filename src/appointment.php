<?php

/*
  Appointment page of Dental Information System
*/


// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
    header("location: ../index.php");
}


// Database connection
require_once('../config/connection.php');
$db = DB();

// Application library ( with Library class )
require_once('../functions/library.php');
$lib = new Library();

$user = $lib->GetUserDetails($_SESSION['user_id']); // get user account details



?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- bootstrap-4.0.0-beta.2-dist -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/css/home.css">


<title>Appointment</title>

</head>


 <body>

 	<!-- Navigation menu -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">

      <!-- <a class="navbar-brand" href="#">Dental Information System</a> -->

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Main </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="patientrecord.php">Patient Record</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Intraoral Examination</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Payment</a>
          </li>
            <li class="nav-item active">
            <a class="nav-link" href="">Appointment <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				       Welcome, <?php echo $user->username ?>!
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Settings</a>
              <a class="dropdown-item" href="/src/logout.php">Logout</a>
            </div>
          </li>
         </ul>
        </form>
      </div>
    </nav>

    <main role="main" class="container">

      <div class="starter-template">
        <h1>Appointment</h1>
        <p class="lead">Appointment page of the system</p>
      </div>

    </main><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<script src="/js/bootstrap.min.js"></script>
</body>

<footer>
</footer>

</html>



