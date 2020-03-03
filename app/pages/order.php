<?php
	include_once('../../class/init.php');

    $login->checkIfLogin();
    
    $cost=$sellout->getTotalCost(2,$_SESSION['invoice_id']);
    $cost2=$cost['cost2'];
    $cost1=$cost['cost1'];

	if(isset($_GET['var'])){
		//note $id = inoice number;
		$_SESSION['invoice_id']=$_GET['var'];
		header("Location: order.php");
	}

	if(isset($_GET['del']) && isset($_GET['invoice'])){
		$item = $_GET['del'];
		$invoice = $_GET['invoice'];
        if($sellout->deleteItem($item,$invoice)){
        	$sellout->countItem($invoice);
        }
	}

    if(isset($_POST['newItem'])){
        $sellout->addItems($_POST,2);
        header("Location: order.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>order(s)</title>
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
	<div id="wrapper">
		<?php
			include_once('header.php');
			include_once('navbar.php');
		?>

		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header"><i class="fa fa-book"> Order Book</i></h1>
                    <!-- <p class="help-block" style="margin-top: -4%; font-style: italic;">Note you cant move to the next stage until you complete this stage.</p> -->
                </div>
            </div>
            <div class="row">
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="row">
                        </div>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>product type</th>
                                    <th>Description</th>
                                    <th>size</th>
                                    <th>quantity</th>
                                    <th>cost</th>
                                    <th>cobbler_cost</th>
                                    <th>cobbler price</th>
                                    <th>company price</th>
                                    <th>delete item</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   $action->getOrders($_SESSION['invoice_id'],1);
                                ?>
                            </tbody>
                        </table>
                        <?php $data=$action->getOrderContact($_SESSION['invoice_id']);?>
                        <p>Customer Name: <?php echo strtoupper($data['customer_name'])?></p>
                        <p>Delivery Location: <?php echo $data['location'].' state'?></p>
                        <p>invoice number: <?php echo $_SESSION['invoice_id']?></p>
                        <p>Amount Paid: <?php echo $data['amount_paid'].'.00'?></p>
                        <p>Total Cost: <?php echo $cost2.'.00' ?></p>
                        <p>Balance: <?php echo $cost2 - $data['amount_paid'].'.00'?></p>
                        <p>Profit: <?php echo $cost2 - $cost1.'.00' ?></p>
                        <p>Date: <?php echo $data['order_date']?></p>
                    </div>
                            <!-- /.table-responsive -->
                <a data-toggle="modal" href="#" data-target="#addItem" class="btn btn-primary"><i class="fa fa-plus"></i> item(s)</a>
                <a href="Newprint.php?invoice=<?php echo $_SESSION['invoice_id']?>" class="btn btn-success">Generate new invoice!</a>
                </div>
            </div>
        </div>
	</div>

    <!-- ADD ITEM(S) MODAL -->
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Order Slip</h5>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"> Shopping Slip</i></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-success">
                            Make your order(s) | fields marked * are compulsory
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <input type="hidden" name="invoice" value="<?php echo $_SESSION['invoice_id']?>">
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
                                        <input type="submit" name="newItem" class="btn btn-success">
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
            </div><br>
            <div class="row">
                <div class="col-md-12">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger close" data-dismiss="modal">x</button>
                  </div>  
                </div>
            </div>
          </div>
        </div>
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