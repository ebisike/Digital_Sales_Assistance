<?php
	include_once('../class/init.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>order placement</title>
	<link rel="icon" type="image/ico" href="../img/logo/icon.png">
	 <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../styles/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../styles/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../styles/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../styles/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/shop-item.css" rel="stylesheet">
</head>
<body>
	<style type="text/css">
		.actions{
			margin-top: 8%;
			margin-left: 0%;
		}
	</style>
	<div class="container-fluid">
		<div class="row">
			<?php include_once('../header.php')?>
		</div>
		<div class="row">
			<?php include_once('../navbar.php')?>
			<div class="col-lg-9 actions">
				<div class="col-lg-12">
					<h4 class="text-muted">Action Buttons!</h4>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<a href="#" class="block" data-toggle="modal" data-target="#invoice">Buy a new item</a>
					</div>
					<div class="col-lg-4">
						<a href="#" class="">print out</a>
					</div>
					<div class="col-lg-4">
						<a href="#" class="">end</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODALS -->
	<div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Invoice Generation Slip</h5>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                  	<h5>click on the button to generate 100 invoice slips</h5>
                    <input type="submit" name="generate" value="generate" class="btn btn-primary">
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
</body>
</html>