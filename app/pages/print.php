<?php
	include_once('../../class/init.php');

    $login->checkIfLogin();
    
    $payment=''; //echo $_SESSION['payment_status'];
    if($_SESSION['payment_status']){
        $Payment = '<p class="text-success" style="color:green">Payment Status: Paid in Full</p>';
    }else{
        $Payment = '<p class="text-danger" style="color: red">Payment Status: Part Payment</p>';
    }

	//getting the total cost of a given cart
    $cost=$sellout->getTotalCost(1,0);
    $bal =$cost - $_SESSION['amt_paid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>invoice for <?php echo $_SESSION['customer']?></title>
	<link rel="icon" type="image/ico" href="/sunesismobile/img/logo/icon.png">

	<!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="contianer">
		<div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="background-color: white">
            <div id="print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group custom-search-form">
                        <a class="navbar-brand" href="#"><img src="/sunesismobile/img/logo/sunesis.png" class="img-fluid" style="width: 60%; margin-left: 20%; margin-top: 5%"></a>
                     </div><br><br><br>
                    <h2 class="page-header"><i class="fa fa-shopping-cart"> Invoice Printout</i></h2>
                   <!--  <p class="help-block" style="margin-top: -2%; font-style: italic;">Invoice Number: </p> -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <b>
                        <p>Customer's Name: <?php echo $_SESSION['customer']?></p>
                        <p>Delivery Location: <?php echo $_SESSION['location'].' state'?></p>
                        <p>Date: <?php echo date('d-M-Y')?></p>
                    </b>
                </div>
                <div class="col-lg-6">
                    <b>
                        <p>Total cost: <?php echo '#'.$cost.'.00'?></p>
                        <p>Amount Paid: <?php echo '#'.$_SESSION['amt_paid'].'.00'?></p>
                        <p>Balance: <?php echo '#'.$bal.'.00'?></p>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body">
                            <div class="table-responsive"><?php echo 'Invoice Number: '.$_SESSION['invoice']. $Payment?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>product type</th>
                                            <th>Description</th>
                                            <th>shoe size</th>
                                            <th>Quantity</th>
                                            <th>Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sellout->getCartRecords(2);?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
            </div><!-- End Print DIv -->
            <img src="/sunesismobile/img/sign.png" class="img-responsive" style="width: 30%; margin: auto auto auto">
            <hr style="width: 50%; border-width: 3px; border-color: grey">
            <p style="margin-left: 40%">seller's signature</p>
            <a href="home.php" class="btn btn-success" onclick="printout()">Print out!</a>
            </div>
            <div class="col-lg-3"></div>
        </div>
	</div>

    <script type="text/javascript">
        function printout(){
            var div = document.getElementById("print");
            window.print(div);
        }
    </script>

	<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>
</html>