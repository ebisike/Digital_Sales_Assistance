<?php
    include_once('../../class/init.php');
     $_SESSION['last_activity']=time();
    $_SESSION['expire_time']=10;


    $login->checkIfLogin();


    if(isset($_POST['payUpdate'])){
        $sellout->updatePay($_POST);
        header("Location: records.php");
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

    <title>Account Book</title>
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
                    <h1 class="page-header"><i class="fa fa-book"> Account Book</i></h1>
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
                                    <th>invoice number</th>
                                    <th>customer name</th>
                                    <th>payment status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   $action->usedInvoice();
                                ?>
                            </tbody>
                        </table>
                    </div>
                            <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- UPDATE PAYMENT Modal -->
    <div class="modal fade" id="updatepay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment Update Slip</h5>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                  <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                      <div class="form-group">
                          <label>Enter Remaining Balance</label>
                          <input type="number" name="pay" class="form-control" required placeholder="Enter Remaining Balance">
                      </div>
                      <div class="form-group">
                          <label>Enter invoice number</label>
                          <input type="number" name="invoice" class="form-control" required placeholder="Invoice Number">
                      </div>
                      <input type="submit" name="payUpdate" value="Update Pay!" class="btn btn-success">
                  </form>
                </div>
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
