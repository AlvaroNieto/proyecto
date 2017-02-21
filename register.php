<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="register.css?v=4z/t6@EHm4">
    <link rel="stylesheet" type="text/css" href="index.css?v='#kl)soen/at|=0s3x">
    </head>
    <body>
      <?php
      session_start();
      var_dump($_SESSION);
      if (!isset($_POST['register'])) {
        var_dump($_POST);
        var_dump(" TEST");
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
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Contact</a></li>
                  </ul>
                  <form class="navbar-form navbar-left">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                  <ul class="nav navbar-nav navbar-right">
                    <!--Login-->
                       <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'
                        aria-haspopup='true' aria-expanded='false'>Log in<span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                          <form class='navbar-form navbar-left' method='POST' action='login.php'>
                            <div class='form-group'>
                                <!--user-->
                              <input type='text' class='form-control' name='user' placeholder='user'><br><br>
                                <!--password-->
                              <input type='password' class='form-control' name='password' placeholder='password'><br><br>
                            </div>
                            <input type='checkbox' id='remember' name='remember' value='rememberme'>
                              <label for='remember'>Remember me</label>
                            <button type='submit' class='btn btn-default' value='login'>Log In</button>
                          </form>
                        </ul>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>

          </div>
          <div class="col-md-12" id="sidebar">
            <form id="registerform" method="POST" onSubmit="return validationPass();" action="registerer.php" >
              <div class="form-group" method="POST">
                <label for="username">Username</label>
                <input required type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                <br />
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <br />
                <label for="password">Password</label>
                <input required type="password" name="password" class="form-control" id="password" placeholder="Password">
                <br />
                <label for="password2">Confirm password</label>
                <input required type="password" name="password2" class="form-control" id="password2" placeholder="Password2">
                <br />
                <label for="name1">Name</label>
                <input required type="text" name="name" class="form-control" id="name1" placeholder="Manolo">
                <br />
                <label for="surname">Surnames</label>
                <input required type="text" name="surname" class="form-control" id="surname" placeholder="El del Bombo">
                <br />
                <label for="address">Address</label>
                <input required type="text" name="address" class="form-control" id="address" placeholder="Sevilla C/ Piruleta 123">
              </div><br/>
                <button type="submit" value="register" class="btn btn-primary">Register!</button>
            </form>
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
        <?php
         ?>
         <script src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>
         <script type="text/javascript" src="js/bootstrap.min.js"></script>
          <script type="text/javascript" src="js/check.js">
          </script>
    </body>
</html>
