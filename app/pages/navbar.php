            <div class="navbar-default sidebar" role="navigation" style="margin-top: -0%">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                              <a class="navbar-brand" href="#"><img src="/sunesismobile/img/logo/sunesis.png" class="img-fluid" style="width: 110%"></a>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gear fa-fw"></i> Sales<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a data-toggle="modal" href="#" data-target="#statement"><i class="fa fa-wrench"></i> generate invoice booklet</a>
                                </li>
                                <li>
                                    <a data-toggle="modal" href="#" data-target="#cart-slip"><i class="fa fa-shopping-cart"></i> Order(s) slip</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="records.php"><i class="fa fa-book fa-fw"></i> Record book</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

            <!-- Cart Modal -->
    <div class="modal fade" id="cart-slip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Error Correction Slip</h5>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                  <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                      <div class="form-group">
                          <label>First get a slip id</label>
                      </div>
                      <div class="form-group">
                          <select class="form-control" name="location">
                            <option>Delivery destination</option>
                            <option value="Abia">Abia</option>
                            <option value="Adamawa">Adamawa</option>
                            <option value="Akwa Ibom">Akwa Ibom</option>
                            <option value="Anambra">Anambra</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Bayelsa">Bayelsa</option>
                            <option value="Benue">Benue</option>
                            <option value="Borno">Borno</option>
                            <option value="Cross River">Cross River</option>
                            <option value="Delta">Delta</option>
                            <option value="Ebonyi">Ebonyi</option>
                            <option value="Edo">Edo</option>
                            <option value="Ekiti">Ekiti</option>
                            <option value="Enugu">Enugu</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Imo">Imo</option>
                            <option value="Jigawa">Jigawa</option>
                            <option value="Kaduna">Kaduna</option>
                            <option value="Kano">Kano</option>
                            <option value="Kastina">Kastina</option>
                            <option value="Kebbi">Kebbi</option>
                            <option value="Kogi">Kogi</option>
                            <option value="Kwara">Kwara</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Nassarawa">Nassarawa</option>
                            <option value="Niger">Niger</option>
                            <option value="Ogun">Ogun</option>
                            <option value="Ondo">Ondo</option>
                            <option value="Osun">Osun</option>
                            <option value="Oyo">Oyo</option>
                            <option value="Plateau">Plateau</option>
                            <option value="Rivers">Rivers</option>
                            <option value="Sokoto">Sokoto</option>
                            <option value="Taraba">Taraba</option>
                            <option value="Yobe">Yobe</option>
                            <option value="Zamfara">Zamfara</option>
                            <option value="FCT">FCT</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label>customer's name *</label>
                        <input class="form-control" type="text" placeholder="fullname" name="name" required>
                      </div>
                      <div class="form-group">
                        <input class="form-control" type="number" placeholder="money paid" name="amt_paid" required><span>
                        <input type="checkbox" name="payment_status" value="1"> Full payment</span>
                      </div>
                      <input type="submit" name="slip-id" value="get slip id" class="btn btn-warning">
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

            <!-- ACCOUNT STATEMENT Modal -->
    <div class="modal fade" id="statement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generate Invoice booklet</h5>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                  <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                      <div class="form-group">
                          <label>Click the button below to generate an invoice booklet</label>
                      </div>
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

    <?php
        //Generate statement of account
        if(isset($_POST['generate'])){
            $today = date('Y-m');
                //perform statement action.
                $action->invoice();
        }

        if(isset($_POST['slip-id'])){
            if($data=$sellout->getInvoice($_POST)){
                header("Location: /sunesismobile/app/pages/cart.php");
            }
        }
    ?>

    