<!DOCTYPE html>
<html lang="" style="height:100%;">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body style="height:100%;">
      <?php
      include_once("php/connection.php");
      session_start();
      if ($_SESSION == NULL) {
        $_SESSION["user"]= "unloged";
      }
      ?>
       <?php
       if ($_SESSION["type"] == "admin") {
         include_once("controlpanel.php");
       }
        ?>
        <div class="col-md-12" id="container" style="min-height:100%;">
          <div class="col-md-12" id="header">
                        <a href="index.php"><img class="pull-left" src="images/logo.png" style="height:50px; width:auto;"/></a>
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
                  unset($connection);
                    ?>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>

          </div>
          <div class="col-md-12" id="content">
            <p>asdasd</p>
            <p>asdasd</p>
            <p>872346782</p>
            <p>dawdwada</p>
            <p>wdawdaw</p>
            <p>awdawda</p>
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
        <?php
         ?>
         <script src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>
         <script type="text/javascript" src="js/bootstrap.min.js">
         </script>
         <script type="text/javascript" src="js/check.js">
         </script>
    </body>
</html>
