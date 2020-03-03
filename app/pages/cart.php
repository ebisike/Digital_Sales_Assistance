<?php
    include_once('../../class/init.php');
    $_SESSION['last_activity']=time();
    $_SESSION['expire_time']=10;


    $login->checkIfLogin();

    $payment=''; //echo $_SESSION['payment_status'];
    if($_SESSION['payment_status']){
        $Payment = '<p class="text-success">Paid in Full</p>';
    }else{
        $Payment = '<p class="text-danger">Part Payment</p>';
    }

    //getting the total cost of a given cart
    $cost=$sellout->getTotalCost(1,0);
    $bal =$cost - $_SESSION['amt_paid'];

    if(isset($_POST['buy'])){
        $sellout->addItems($_POST,1);
        header("Location: cart.php");
    }

    //deleting an item from cart
    if(isset($_GET['var'])){
        $id = $_GET['var'];
        $sellout->deleteItem($id,0);
        header("Location: cart.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>credit</title>
    <link rel="icon" type="image/ico" href="/sunesismobile/img/logo/icon.png">

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <style type="text/css">
        #icon{
            width: 15%;
            float: left;
            margin-left: 5%;
        }
    </style>
    <div id="wrapper">

<?php
    include_once('header.php');
    include_once('navbar.php');
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header"><i class="fa fa-edit"> Shopping Slip</i></h1>
                    <a class="help-block" href="#cart" style="margin-top: -4%; font-style: italic;">click here to view shopping cart.</a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-success">
                            Make your order(s) | fields marked * are compulsory
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <div class="form-group">
                                            <label>Product type *</label>
                                            <input list="income" class="form-control" placeholder="Enter Product type" name="product" required>
                                            <datalist id="income">
                                                <option value="Sandals">
                                                <option value="Pams">
                                                <option value="Brooks">
                                                <option value="Covered Shoes">
                                            </datalist>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="qty" placeholder="Enter Quantity" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>shoe size *</label>
                                            <input class="form-control" type="number" placeholder="shoe size" name="size" required>
                                        </div>
                                        <div class="form-group">
                                            <label>cobbler's price *</label>
                                            <input class="form-control" type="number" placeholder="cobbler price" name="price1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>actual price *</label>
                                            <input class="form-control" type="number" placeholder="company price" name="price2" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" cols="5" placeholder="Enter shoe description *" name="desc" required></textarea>
                                        </div>
                                        <input type="submit" name="buy" class="btn btn-success">
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                <div id="aform"></div>
            </div>
            <!-- /.row -->
            <div class="row" id="cart">
                <div class="col-lg-12">
                    <h4 class="page-header"><i class="fa fa-shopping-cart"> mCart <?php echo $_SESSION['invoice']?></i></h4>
                    <a class="help-block" href="#page-wrapper" style="margin-top: -2%; font-style: italic;">back to top!</a>
                    <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>product type</th>
                                            <th>Description</th>
                                            <th>shoe size</th>
                                            <th>Quantity</th>
                                            <th>Cost</th>
                                            <th>Cobbler Cost</th>
                                            <th>unit price (cobbler)</th>
                                            <th>unit price (company)</th>
                                            <th>delete item</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sellout->getCartRecords(1);?>
                                    </tbody>
                                </table>
                                <p>Customer's Name: <?php echo $_SESSION['customer']?></p>
                                <p>Delivery Location: <?php echo $_SESSION['location'].' state'?></p>
                                <p>Amount Paid: <?php echo '#'.$_SESSION['amt_paid'].'.00'?></p>
                                <p>Total cost: <?php echo '#'.$cost.'.00'?></p>
                                <p>Balance: <?php echo '#'.$bal.'.00'?></p>
                                Payment Status: <?php echo $Payment; ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                </div>
                <a href="print.php" class="btn btn-warning">Check out!</a>
            </div>
            <!-- php code here -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
