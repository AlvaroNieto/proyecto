l<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.1.1.js">
    </script>
    <script>
    <?php
    $connection = new mysqli("localhost", "root", "Alvaro", "tienda");
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }
    $sql2="select pic from item ORDER BY `reference` DESC";
    $result2 = $connection->query($sql2);
    $n=1;
    while ($obj2 = $result2->fetch_object()) {
      ${"image".$n}=$obj2->pic;
      $n++;
    }
    ?>
    </script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js">
    <link rel="stylesheet" type="text/css" href="index.css?v=0xkl)ip/t|=7s3x">
    </head>
    <body>
      <?php
      session_start();
      var_dump($_SESSION);
      var_dump($_POST);
      if ($_SESSION == NULL) {
        $_SESSION["user"]= "unloged";
        $_SESSION["type"]= "none";
      }

      ?>


     <div class="container">
       <?php
       if ($_SESSION["type"] == "admin") {
         echo "<a class='btn btn-primary btn-xs'
         href='productcreator.php'>Product management</a>";
         echo "<a class='btn btn-primary btn-xs'
         href='usermanagement.php'>Users management</a>";
       }
        ?>
        <div class="col-md-12" id="container">
          <div class="col-md-12" id="header">
            <nav class="navbar navbar-default" id="navbar">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed"
                  data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1"
                  aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand active" href="index.php">Home</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="#">Cart</a></li>
                    <li><a href="contact.php">Contact</a></li>
                  </ul>
                  <form class="navbar-form navbar-left">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                  <ul class="nav navbar-nav navbar-right">
                    <!--Login-->

                    <?php

                    if($_SESSION["user"] == "unloged" or "" ) {
                       echo "
                       <li><a href='register.php'>Register</a></li>
                       <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'
                        aria-haspopup='true' aria-expanded='false'>Log in<span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                          <form class='navbar-form navbar-left' id='loger' method='POST' action='login.php'>
                            <div class='form-group'>
                                <!--user-->
                              <input type='text' class='form-control' name='user' placeholder='user' required><br><br>
                                <!--password-->
                              <input type='password' class='form-control' name='password' placeholder='password' required><br><br>
                            </div>
                            <input type='checkbox' id='remember' name='remember' value='rememberme'>
                              <label for='remember'>Remember me</label>
                            <button type='submit' class='btn btn-default' value='login'>Log In</button>
                          </form>
                        </ul>
                      </li>";
                    } else { echo "
                      <li><a href='profile.php'>".$_SESSION['user']."</a></li>
                      <li><a id='logerout' onclick='return alertlogout()' href='#' value='logout'>Logout</a></li>
                      ";
                  }

                    ?>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>

          </div>
          <div class="col-md-2" id="content">
            <fieldset>
              <legend>Filtrar:</legend>
              <form method="post" action="index.php">
                <div class="form-group">
                  <label for="sel1">Motor</label>
                  <select multiple class="form-control" name="type" id="sel1">
                    <?php
                      $sql="select DISTINCT type from item;";
                      $result = $connection->query($sql);
                      while ($obj = $result->fetch_object()) {
                        echo "<option>$obj->type</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel4">Tracción</label>
                  <select multiple class="form-control" name="traction" id="sel4">
                    <?php
                      $sql="select DISTINCT traction from item;";
                      $result = $connection->query($sql);
                      while ($obj = $result->fetch_object()) {
                        echo "<option>$obj->traction</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel2">Chasis</label>
                  <select multiple class="form-control" name="chassis" id="sel2">
                    <?php
                      $sql="select DISTINCT chassis from item;";
                      $result = $connection->query($sql);
                      while ($obj = $result->fetch_object()) {
                        echo "<option>$obj->chassis</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel3">Transmisión</label>
                  <select multiple class="form-control" name="transmission" id="sel3">
                    <?php
                      $sql="select DISTINCT transmission from item;";
                      $result = $connection->query($sql);
                      while ($obj = $result->fetch_object()) {
                        echo "<option value='$obj->transmission'>$obj->transmission</option>";
                      }
                     ?>
                  </select>
                </div>
                <input type="submit" class="btn btn-default btn-xs" value="Filtrar">
            </form>
            </fieldset>
            <!--
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Tutorials
              <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">W3Schools</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HTML</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSS</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>
              </ul>
            </div>-->

          </div>
          <div class="col-md-10" id="sidebar">
           <div class="container" id="highlights">
              <div id="products" class="row list-group">
                <?php
                $sql = "SELECT * FROM ITEM ORDER BY REFERENCE DESC;";
                $result = $connection->query($sql);
                for ($i=0; $i < 4; $i++) {
                  $obj = $result->fetch_object();
                  echo '<div class="item  col-xs-6 col-lg-6">
                          <div class="thumbnail">
                              <img class="group list-group-image" src="'.$obj->pic.'" id="imageslist" alt="" />
                              <div class="caption">
                                  <h4 class="group inner list-group-item-heading">
                                      '.$obj->name.'</h4>
                                  <p class="group inner list-group-item-text" id="itemdescription">
                                      '.$obj->description.'</p>
                                  <div class="row">
                                      <div class="col-xs-12 col-md-6">
                                          <p class="lead">
                                              '.$obj->value.'€</p>
                                      </div>
                                      <div class="col-xs-12 col-md-6">
                                          <a class="btn btn-success" href="#">Add to cart</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>';
                }
                 ?>
                  <!--<div class="item  col-xs-5 col-lg-5">
                      <div class="thumbnail">
                          <img class="group list-group-image" src="<?php echo "$image1" ?>" id="imageslist" alt="" />
                          <div class="caption">
                              <h4 class="group inner list-group-item-heading">
                                  Product title</h4>
                              <p class="group inner list-group-item-text">
                                  Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                              <div class="row">
                                  <div class="col-xs-12 col-md-6">
                                      <p class="lead">
                                          $21.000</p>
                                  </div>
                                  <div class="col-xs-12 col-md-6">
                                      <a class="btn btn-success" href="#">Add to cart</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="item  col-xs-5 col-lg-5">
                      <div class="thumbnail">
                          <img class="group list-group-image" src="<?php echo "$image2" ?>" id="imageslist" alt="" />
                          <div class="caption">
                              <h4 class="group inner list-group-item-heading">
                                  Product title</h4>
                              <p class="group inner list-group-item-text">
                                  Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                              <div class="row">
                                  <div class="col-xs-12 col-md-6">
                                      <p class="lead">
                                          $21.000</p>
                                  </div>
                                  <div class="col-xs-12 col-md-6">
                                      <a class="btn btn-success" href="#">Add to cart</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="item  col-xs-5 col-lg-5">
                      <div class="thumbnail">
                          <img class="group list-group-image" src="<?php echo "$image3" ?>" id="imageslist" alt="" />
                          <div class="caption">
                              <h4 class="group inner list-group-item-heading">
                                  Product title</h4>
                              <p class="group inner list-group-item-text">
                                  Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                              <div class="row">
                                  <div class="col-xs-12 col-md-6">
                                      <p class="lead">
                                          $21.000</p>
                                  </div>
                                  <div class="col-xs-12 col-md-6">
                                      <a class="btn btn-success" href="#">Add to cart</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="item  col-xs-5 col-lg-5">
                      <div class="thumbnail">
                          <img class="group list-group-image" src="<?php echo "$image4" ?>" id="imageslist" alt="" />
                          <div class="caption">
                              <h4 class="group inner list-group-item-heading">
                                  Product title</h4>
                              <p class="group inner list-group-item-text">
                                  Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                              <div class="row">
                                  <div class="col-xs-12 col-md-6">
                                      <p class="lead">
                                          $21.000</p>
                                  </div>
                                  <div class="col-xs-12 col-md-6">
                                      <a class="btn btn-success" href="#">Add to cart</a>
                                  </div>
                              </div>
                          </div>
                      </div>-->
                  </div>
               </div>
            </div>

          <!-- footer -->
          <div class="col-md-2" id="footerL">
            <address>
              <strong>2AsirTriana</strong><br>
              1355 Market Street, Suite 900<br>
              San Francisco, CA 94103<br>
            </address>
          </div>
          <div class="col-md-8" id="footer">

          </div>
          <div class="col-md-2" id="footerR">
            <address>
              <strong>Full Name</strong><br>
                <abbr title="Phone">P:</abbr> (123) 456-7890
              <a href="mailto:#">first.last@example.com</a>
            </address>
          </div>
          <!-- end of footer -->
          </div>
        </div>
      </div>
        </div>
        <?php

         ?>

         <script type="text/javascript" src="js/bootstrap.min.js">
         </script>
         <script type="text/javascript" src="js/check.js">
         </script>
    </body>
</html>
