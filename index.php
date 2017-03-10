<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiendacoches</title>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
      <?php
      include_once("php/connection.php");
      session_start();
      if ($_SESSION == NULL) {
        $_SESSION["user"]= "unloged";
        $_SESSION["type"]= "none";
      }


      if (isset($_GET["page"])) {
        $page = $_GET["page"];
        unset($_GET["page"]);
      } else { $page = 1; }
      ?>

       <?php
       if ($_SESSION["type"] == "admin") {
         include_once("controlpanel.php");
       }
        ?>
        <div class="col-md-12" id="container">
          <div class="col-md-12" id="header">
            <a href="index.php"><img class="pull-left" src="images/logo.png" style="height:50px; width:auto;"/></a>
            <nav class="navbar navbar-default" id="navbar" >
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
                    <li><a href="cart.php">Cart <?php if(isset($_SESSION['cartadd']) && !empty($_SESSION['cartadd'])) {echo "<i class='glyphicon glyphicon-exclamation-sign'></i>";}?></a></li>
                    <li><a href="contact.php">Contact</a></li>
                  </ul>
                  <form class="navbar-form navbar-left" method="GET" action="index.php">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search" name="searchname" required>
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
                          <form class='navbar-form navbar-left' id='loger' method='POST' action='php/login.php'>
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
          <div id="insider" class="col-md-12" style="margin-bottom:20px">
            <div class="col-md-2" id="content">
              <fieldset>
                <legend>Filtrar:</legend>
                <form method="GET" action="index.php">
                  <div class="form-group">
                    <label for="sel3">Items per page:</label>
                    <select class="form-control" name="amount" id="sel5">
                      <option
                      <?php
                        if (!isset($_GET['amount']) or $_GET['amount']=='4') {
                          echo "selected='selected'";
                        }
                      ?>
                      value='4'>4</option>";
                      <option
                        <?php
                          if ($_GET['amount']=='8') {
                            echo "selected='selected'";
                          }
                        ?>
                        value='8'>8</option>";
                      <option
                      <?php
                        if ($_GET['amount']=='12') {
                          echo "selected='selected'";
                        }
                      ?>
                       value='12'>12</option>";
                      <option
                      <?php
                        if ($_GET['amount']=='16') {
                          echo "selected='selected'";
                        }
                      ?>
                       value='16'>16</option>";
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sel1">Motor</label>
                    <select multiple class="form-control" name="type[]" id="sel1">
                      <?php
                        $sql="select DISTINCT type from item;";
                        $result = $connection->query($sql);
                        $setter = $_GET['type'];
                        while ($obj = $result->fetch_object()) {
                          echo "<option";
                          for ($i=0; $i < count($setter); $i++) {
                            if ($setter[$i] == $obj->type) {
                            echo " selected='selected'>$obj->type</option>";
                            array_shift($setter);
                          }
                        }
                          echo ">$obj->type</option>";
                        }
                       ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sel4">Tracción</label>
                    <select multiple class="form-control" name="traction[]" id="sel4">
                      <?php
                        $sql="select DISTINCT traction from item;";
                        $result = $connection->query($sql);
                        $setter = $_GET['traction'];
                        while ($obj = $result->fetch_object()) {
                          echo "<option";
                          for ($i=0; $i < count($setter); $i++) {
                            if ($setter[$i] == $obj->traction) {
                            echo " selected='selected'>$obj->traction</option>";
                            array_shift($setter);
                          }
                        }
                          echo ">$obj->traction</option>";
                        }
                       ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sel2">Chasis</label>
                    <select multiple class="form-control" name="chassis[]" id="sel2">
                      <?php
                        $sql="select DISTINCT chassis from item;";
                        $result = $connection->query($sql);
                        $setter = $_GET['chassis'];
                        while ($obj = $result->fetch_object()) {
                          echo "<option";
                          for ($i=0; $i < count($setter); $i++) {
                            if ($setter[$i] == $obj->chassis) {
                            echo " selected='selected'>$obj->chassis</option>";
                            array_shift($setter);
                          }
                        }
                          echo ">$obj->chassis</option>";
                        }
                       ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sel3">Transmisión</label>
                    <select multiple class="form-control" name="transmission[]" id="sel3">
                      <?php
                        $sql="select DISTINCT transmission from item;";
                        $result = $connection->query($sql);
                        $setter=$_GET['transmission'];
                        while ($obj = $result->fetch_object()) {
                          echo "<option";
                          for ($i=0; $i < count($setter); $i++) {
                            if ($setter[$i] == $obj->transmission) {
                              echo " selected='selected'";
                            }
                          }
                          echo ">$obj->transmission</option>";
                      }

                       ?>
                    </select>
                  </div>
                  <input type="submit" class="btn btn-default" value="Filtrar">
              </form>
              </fieldset>
            </div>
            <div class="col-md-10" id="sidebar">
             <div class="container" id="highlights">
                <div id="products" class="row list-group">
                  <?php

                  $counter = 1;
                  if (isset($_GET['amount'])) {
                    $stopper = $_GET['amount'];
                  } else {
                    $stopper = 4;
                  }
                  $build = '';
                  if ($page!=1) {
                    $max = $stopper*$page-$stopper;
                    $limit = " LIMIT $max, $max";
                  } else {$limit = '';}

                  if (isset($_GET['searchname'])) {
                    $sql = "SELECT * FROM item WHERE name like '%".$_GET['searchname']."%'ORDER BY REFERENCE DESC $limit;";
                  } else {
                  if (key($_GET) == "amount") {array_shift($_GET);}
                  if (empty($_GET)) {
                      $sql = "SELECT * FROM item ORDER BY REFERENCE DESC $limit;";
                    } else {
                      $build = 'WHERE (';
                      foreach ($_GET as $key => $value) {
                        if (isset($_GET[$key])) {
                          foreach ($_GET["$key"] as $key1 => $value1) {
                            $build = $build."$key = '$value1' ";
                            if (end($_GET["$key"])!==$value1) {
                                $build = $build."OR ";
                              } elseif (end($_GET["$key"])==$value1) {
                                    $build = $build.") AND (";
                              }
                            }
                          }
                        }
                        $str= preg_replace('/\W\w+\s*(\W*)$/', '$1', $build);
                        $str= substr($str, 0, -1);


                        $sql = "SELECT * FROM item $str
                         ORDER BY REFERENCE DESC $limit;";

                     }
                   }
                    $result = $connection->query($sql);
                    if (mysqli_num_rows($result) == 0) {
                      echo "No results found.";
                     }
                    while ($obj = $result->fetch_object()) {
                    echo '<div class="item  col-xs-12 col-lg-6" style="margin-top:10px">
                            <div class="thumbnail">
                               <a href="item.php?id='.$obj->reference.'">
                                <img class="group list-group-image" src="'.$obj->pic.'" id="imageslist" alt="" />
                                </a>
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
                                            <a class="btn btn-success" name="buy" href="php/cartadd.php?id='.$obj->reference.'">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        if ($counter == $stopper) {break;}
                              $counter++;
                    }

                   ?>
                    </div>
                 </div>
                 <div class='col-xs-12 col-md-12' style="margin-top: 15px">
                 <?php
                 $sql = "SELECT * FROM item $str
                  ORDER BY REFERENCE DESC";
                 $result = $connection->query($sql);
                 $maxpage = mysqli_num_rows($result);
                 $maxpage = ceil($maxpage / $stopper);
                 $nextpage=$page+1;
                 $prevpage=$page-1;
                 if (!isset($page)){
                   $page = 1;
                 }
                 $pass="&amount=$stopper";
                 if (end($_GET["amount"])!==$stopper && $stopper==4) {
                       $pass = $pass."&";
                 }
                 foreach ($_GET as $key => $value) {
                   foreach ($_GET[$key] as $key1 => $value1) {
                     $pass=$pass."&".$key."%5B%5D=".$value1;
                   }
                 }
                  if ($page !== NULL && $page >1 ) {
                    echo "<a class='btn btn-success pull-left' style='margin-bottom:20px;'
                        name='buy' href='index.php?page=$prevpage$pass'>Previous page</a>";
                  }
                  if ($maxpage > $page) {
                    echo "<a class='btn btn-success pull-right' style='margin-bottom:20px;'
                        name='buy' href='index.php?page=$nextpage$pass'>Next page</a>";
                    }
                  ?>
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
            <p> Mensaje de cookies generico </p>
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

        <?php

        unset($connection);
         ?>

         <script type="text/javascript" src="js/bootstrap.min.js">
         </script>
         <script type="text/javascript" src="js/check.js">
         </script>
    </body>
</html>
