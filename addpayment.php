<?php

// Start Session
session_start();

// Database connection
    require_once('../config/connection.php');
    $db = DB();

$total_rows=0;

if(isset($_POST["btn_barcode"])){
  if($_POST["chargebarcode"] == ""){

  }

  else{
    $statement = $db->prepare("SELECT r.docointkey,r.pcchrgcod, r.dodate, r.dmdcomb, r.pchrgqty, r.pchrgup, r.discount, r.disamt, r.pcchrgamt, r.docointkey, p.hpercode,CONCAT(p.patlast,', ',p.patfirst,' ',IF(p.patmiddle = '' OR p.patmiddle IS NULL,'',CONCAT(LEFT(p.patmiddle,1),'.'))) AS name,IF(r.disc_percent='' OR r.disc_percent IS NULL,'0.00',r.disc_percent) AS 'disc_per',IF(r.disc_percent='' OR r.disc_percent IS NULL,'0.00',(r.pchrgup * r.disc_percent)*r.pchrgqty) AS 'disc_amt'
      FROM hrxo AS r
      LEFT JOIN hperson AS p
      ON r.hpercode = p.hpercode
      WHERE pcchrgcod=:charge_slip
      LIMIT 80");

    $statement->bindParam(":charge_slip",$_POST["chargebarcode"],PDO::PARAM_STR);
    $statement->execute();
    $all_result = $statement->fetchAll();
    $total_rows = $statement->rowCount();
  }
}


if(isset($_POST["btn_save"])){

  // echo "<script>alert(\"Save Hello! I am an alert box!\");</script>";

 /*if(isset($_POST["discount"])){

    echo "<script>alert(\"This is the first checkbox!\");</script>";
  }*/

}


$sql = $db->prepare("SELECT (SELECT or_prefix FROM hsetup) AS or_pref,orno
  FROM hpay
  WHERE ordate IN (SELECT MAX(ordate) FROM hpay) AND entryby='002-161'");

$sql->execute();

$result = $sql->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Veterans Regional Hospital</title>
  
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  
  <style>
  #patname-ul{
    background-color:#eee;
    cursor:pointer;
  }
  #patname-li{
    padding:12px;
  }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Veterans Regional Hospital</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.html">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="dietary.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Dietary</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cashier">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCashier" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Cashier Management</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseCashier">
            <li>
              <a href="inpatientcashier.php">In-Patient Payment</a>
            </li>
            <li>
              <a href="outpatientcashier.php">Out-Patient Payment</a>
            </li>
            <li>
              <a href="walkinpatientcashier.php">Walk-In Payment</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Components</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="navbar.html">Navbar</a>
            </li>
            <li>
              <a href="cards.html">Cards</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Example Pages</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="login.html">Login Page</a>
            </li>
            <li>
              <a href="register.html">Registration Page</a>
            </li>
            <li>
              <a href="forgot-password.html">Forgot Password Page</a>
            </li>
            <li>
              <a href="blank.html">Blank Page</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Menu Levels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav> <!-- ----- -->



  <!-- /.content-wrapper -->
  <div class="content-wrapper">

    <!-- /.container-fluid -->
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Cashier Management</a>
        </li>
        <li class="breadcrumb-item">
          <a href="outpatientcashier.php">Out-Patient Pay..</a>
        </li>
        <li class="breadcrumb-item active">Add Payment</li>
      </ol>



      <!-- Outpatient Add Payment Form -->
      <form method="post" id="add_payment_form" role="form">

        
        <div class="row">
        	<div class="col-lg-12">
            <!-- Create Button -->
            <input class="btn btn-primary" type="submit" name="btn_save" value="Save">

            <hr style="margin-top:10px;margin-bottom:10px;">

              <div class="row">
                <!-- Barcode field --> 
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="chargebarcode" name="chargebarcode" placeholder="Barcode" autofocus>
                  </div>
                </div> <!-- /. col-lg-6 -->

 
                <!-- Enter barcode button -->
                <div class="col-lg-6">
                  <input class="btn btn-secondary" type="submit" value="Enter" name="btn_barcode">
                </div> <!-- /. col-lg-2 -->

              </div> <!-- /. row -->

           
              <div class="row">
                <div class="col-lg-1">
                  <div class="form-group">
                    <label>OR Date: </label>
                  </div>  
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <p class="form-control-static" id="ordate">
                      <?php date_default_timezone_set("Asia/Manila"); echo date("m/d/Y h:i:s A"); ?>    
                    </p>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label>OR Number: </label>
                   </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <input type="text" class="form-control" id="ornumber" value=<?php echo $result->or_pref . '-' . ($result->orno + 1); ?>>
                  </div>
                </div>

                <div class="col-lg-3">
                  <p>Space</p>
                </div>

              </div>  <!-- /. row -->

              <div class="row">


                <!-- Patient Name input -->
                <div class="col-lg-12">
                  <input type="text" class= "form-control" name="patientname" id="patientname" placeholder="Patient Name" 
                  value="<?php if($total_rows>0){ foreach($all_result as $row){ echo $row["name"]; break; } } ?>">
                   <div id="patientList">
                  </div> 
                </div>

              </div> <!-- /. row -->


              <div class="row" style="margin-top:10px;">

                <div class="col-lg-1">
                  <label>Currency: </label>
                </div>


                <!-- Currency Select input -->
                <div class="col-lg-5">
                  <select class="form-control" id="input_group_currency">
                    <option> </option>
                    <option value="DOLLA">Dollars</option>
                    <option value="OTHER">Others</option>
                    <option value="PESO" selected>Peso</option>
                    <option value="YEN">Yen</option>
                  </select>
                  <!-- <input type="text" class="form-control" name="currency" id="currency" placeholder="Enter Currency"> -->
                </div>

                <div class="col-lg-1">
                  <label>Notes: </label>
                </div>

                <div class="col-lg-5">
                  <input type="text" class="form-control" name="notes" id="notes" placeholder="Enter Notes">
                </div>

              </div> <!-- /. row -->



              <!-- Mode of payment -->
              <div class="row" style="margin-top:10px;">
                <div class="col-lg-2">
                  <label>Mode of Payment:</label>
                </div>

                <!-- Mode of Payment Select input -->
                <div class="col-lg-4">
                  <!--
                  <input type="text" class="form-control" name="mode_payment" id="mode_payment" placeholder="Enter Mode of Payment">
                  -->
                  <select class="form-control" id="input_group_mode_payment">
                    <option> </option>
                    <option value="C" selected>Cash</option>
                    <option value="X">Check</option>
                  </select>
                </div>


                <!-- Type of payment -->  
                <div class="col-lg-2">
                  <label>Type of Payment:</label>
                </div>

                <!-- Type of Payment Select input -->
                <div class="col-lg-4">
                  <select class="form-control" id="input_group_type_payment">
                    <option value=" "> </option>
                    <option value="A">Additional Deposit</option>
                    <option value="D">Donation</option>
                    <option value="F" selected>Full Payment</option>
                    <option value="I">Initial Deposit</option>
                    <option value="P">Partial Payment</option>
                  </select>
                 <!-- <input type="text" class="form-control" name="type_payment" id="type_payment" placeholder="Enter Type of Payment">
                  -->
                </div>

              </div> <!-- /.row -->


              <!-- Discount Select Input -->
              <div class="row" style="margin-top:10px;">
                
                <div class="col-lg-1">
                  <label>Discount:</label>
                </div> <!-- /.col-lg-1 -->


                <div class="col-lg-4">
                  <select class="form-control" id="input_group_discount">
                    <option value=" " selected> </option>
                    <option value="SENIOR">Senior Citizen</option>
                    <option value="PWD">PWD</option>
                    <option value="0.10">10% Discount</option>
                    <option value="0.20">20% Discount</option>
                    <option value="0.25">25% Discount</option>
                    <option value="0.5">50% Discount</option>
                    <option value="1">100% Discount</option>
                  </select>
                </div> <!-- /.col-lg-4 -->

                <!-- Apply to selected submit button -->
                <div class="col-lg-3">
                  <input type="submit" class="btn btn-default" name="btn_apply_discount" value="Apply to selected" />
                </div> <!-- /.col-lg-3  -->
                
              </div> <!-- /.row -->

            </form> <!-- /#add_payment_form -->
          </div> <!-- /.col-lg-12 -->
        </div> <!-- /.row -->

        <!-- Example DataTables Card-->
        <!-- Charges Table -->
        <table class="table" width="100%" cellspacing="0" style="margin-top:10px;">
          <thead>
            <tr>
              <th>Disc?</th>
              <th>Charge Slip No.</th>
              <th>Date</th>
              <th>Description</th>
              <th>QTY</th>
              <th>Unit Cost</th>
              <th>Discount %</th>
              <th>Discount Value</th>
              <th>Sub-Total</th>
              <th>State</th>
            </tr>
            
          </thead>
          <?php


            if($total_rows > 0){
              $count=0;
              foreach($all_result as $row){
                echo 
                  '<tr id="check_result">
                    <td><input type="checkbox" class="form-control" name="discount[]" id="'.$row["docointkey"].'" value="' .$row["docointkey"]. '" /></td>
                    <td>'.$row["pcchrgcod"].'</td>
                    <td>'.$row["dodate"].'</td>
                    <td>'.$row["dmdcomb"].'</td>
                    <td>'.$row["pchrgqty"].'</td>
                    <td>'.$row["pchrgup"].'</td>
                    <td>'.$row["disc_per"].'</td>
                    <td>'.$row["disc_amt"].'</td>
                    <td>'.$row["pcchrgamt"].'</td>
                    <td>'.$row["docointkey"].'</td>
                  </tr>';

                  $count = $count + 1;
              }

              echo '
                <tr>
                  <td colspan="10" align="left"><a href="#" id="add_row">Add an item</a></td>
                </tr>
                <tr>
                    <td colspan="10"> </td>
                </tr>
                <tr>
                    <td colspan="10"> </td>
                </tr>
                <tr>
                  <td colspan="10"> </td>
                </tr>
              ';
            }
            else{
              for($x=0; $x<3; $x++){
                echo'
                <tr>
                    <td colspan="9"> </td>
                </tr>
              ';
              }
            }



          ?>

          <tr>
            <td colspan="2" alight="right"><input type="checkbox" name="discount" value="1" /></td>
            <td colspan="6" align="right">Total:</td>
            <td colspan="2" align="left"><span id="final_total_amt"><?php if($total_rows>0){
              $sum=0;

              foreach($all_result as $row)
              {
                $sum = $sum + $row['pcchrgamt'];  
                // echo $row['pcchrgamt'];

              }

              echo $sum;
            } ?></span></td>
          </tr>

        </table>

        <span id="check_result_span"></span>

      </form> <!-- /#add_payment_form -->

    </div> <!-- /.container-fluid-->
  


   

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <script src="../js/sb-admin-charts.min.js"></script>

</div> <!-- /.content-wrapper -->

</body>

</html>

<script>
  $(document).ready(function(){
    $('#patientname').keyup(function(){
      var query = $(this).val();
      if(query != ''){
        $.ajax({
          url:"search.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
            $('#patientList').fadeIn();
            $('#patientList').html(data);
          }
        });
      }
    });

  $(document).on('click','li',function() {
    $('#patientname').val($(this).text());
    $('#patientList').fadeOut();
  });


  $(document).read(function(){
    var final_amt = $('#final_total_amt').text();
    var count = 1;
    $(document).on('click','#add_row',function(){
      count = count + 1;
      $('#total_item').val(count);
      var html_code = '';


    })

  })

  });

/*
  function calculate() {
    var arr = $.map($('input:checkbox:checked'), function(e,i){
      return +e.value;
    });
    $('#check_result_span').text('the checked values are: ' + arr.join(','));
  }

  // calculate();

  $('#check_result').delegate('input:checkbox','click',calculate); */



  $("input[type=checkbox]").click(function() {
    alert(this.value);
  });




</script>
