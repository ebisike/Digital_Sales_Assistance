<?php
  include_once('class/init.php');
  /******************************************************************************************************************************************
    General note:
    KEY:
      1 = DATA MANAGEMENT
      2 = FINANCIAL MANAGEMENT

    $_SESSION['user'] implies which application portal is currently openned.

  *******************************************************************************************************************************************/

  if($login->loggedin()){
    header("Location: redirect.php");
    //echo 'user already loggedin';
  }

  //code to handle login process
  if(isset($_POST['login'])) {
    $user_id = $_POST['user_id'];
    $pwd = $_POST['pwd'];
    //echo $type;

    if($result = $login->userlogin($user_id,$pwd)) {
      $id = $result['id'];
      $login->setSessionId($id);
      header("Location: redirect.php");
    }
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

    <title>SUNESIS</title>
    <link rel="icon" type="image/ico" href="/sunesismobile/img/logo/icon.png">

    <!-- Bootstrap Core CSS -->
    <link href="app/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="app/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="app/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="app/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<audio controls autoplay hidden>
  <source src="authcode.ogg" type="audio/ogg">
  <source src="authcode.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <img src="/sunesismobile/img/logo/sunesis.png" class="img-fluid" style="width: 100%; margin-top: 40%; margin-bottom: -20%">
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                       <!--  <a href="index.php"><img src="img/logo.png" class="img-responsive" style="width: 30%; float: right; margin-top: -18%"></a> -->
                    </div>
                    <div class="panel-body">
                        <form role="form" action="index.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User name" name="user_id" type="email" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pwd" type="password" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                               <!--  <input type="submit" class="btn btn-lg btn-success btn-block" name="login" value="Login"> -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" name="login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/sunesismobile/app/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/sunesismobile/app/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/sunesismobile/app/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/sunesismobile/app/dist/js/sb-admin-2.js"></script>

</body>

</html>
