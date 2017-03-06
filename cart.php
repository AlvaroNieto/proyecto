<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto PHP</title>
    <script src="https://code.jquery.com/jquery-3.1.1.js">
    </script>
    <script>
   </script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="cart.css">
    </head>
    <body>
      <?php
      session_start();
      if ($_SESSION['user'] == "unloged") {
        header("Location: index.php");
      } else {
      $connection = new mysqli("localhost", "root", "Alvaro", "tienda");

      //TESTING IF THE CONNECTION WAS RIGHT
      include_once("php/connection.php");
      $sql="select * from users where
      nick='".$_SESSION["user"]."';";

      if ($result = $connection->query($sql)) {
        if ($result->num_rows==0) {
          echo "Error";
          $_SESSION="unloged";
          header("Location: index.php");
        } else {
            $obj = $result->fetch_object();
          }

        } else {
          echo "Wrong Query";
          var_dump($sql);
      }
      }
      ?>
     <div class="container">
       <?php
       if ($_SESSION["type"] == "admin") {
         include_once("controlpanel.php");
       }
        ?>
        <div class="col-md-12" id="container">
          <div class="col-md-12" id="header">
            <nav class="navbar navbar-default" id="navbar">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
          <div class="col-md-12" id="content" style="min-height: 300px;">
            <div class="list-group">
              <form method="GET" action="php/buy.php">
            <?php
            foreach ($_SESSION['cartadd'] as $key => $value) {
              $sql = "SELECT * FROM item WHERE reference = '$value'";
              $result = $connection->query($sql);
              while ($obj = $result->fetch_object()) {
                echo '<div class="list-group-item">
                        <a href="item.php?id='.$obj->reference.'" class="list-group-item col-md-9">
                          <div class="media col-md-4">
                              <figure class="pull-left">
                                  <img class="media-object img-rounded img-responsive"  src="'.$obj->pic.'" >
                              </figure>
                          </div>
                          <div class="col-md-6">
                              <h4 class="list-group-item-heading"> '.$obj->name.' </h4>
                              <p class="list-group-item-text"> '.$obj->description.'
                              </p>
                          </div>
                        </a>
                        <div class="col-md-3 text-center">

                          <label for="quantity"> Quantity
                            <input style="margin-top:10px;" type="number" class="form-control" name="'.$obj->reference.'"  value="1" required>
                          </label>

                            <a style="margin-top:30px;" href="php/cartadd.php?remove='.$obj->reference.'"class="btn btn-primary btn-lg btn-block">
                            Remove
                            </a>
                        </div>
                </div>';
                }
            }


             ?>
            <div style="margin: 0 auto; width: 200px; margin-top: 40px">
                 <input type="submit" class="btn btn-success center-block" value="Comprar"></a>
             </div>
             </form>
              </div>
          </div>
          <!-- footer
          <div class="col-md-3 text-center">
              <h2> 12424 <small> votes </small></h2>
              <button type="button" class="btn btn-primary btn-lg btn-block"> Delete </button>
              <div class="stars">
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star-empty"></span>
              </div>
              <p> Average 3.9 <small> / </small> 5 </p>
          </div>
        -->
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

         <script type="text/javascript" src="js/bootstrap.min.js">
         </script>
         <script type="text/javascript" src="js/check.js">
         </script>



    </body>
</html>
