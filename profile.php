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
     $(function() {
        $( "#toggler" ).click(function() {
          var state = ($( "#submiter" ).prop('disabled'));
          if ( state === false) {
            $( "#submiter" ).prop('disabled',true);
            $( "#alterdata :input" ).prop('disabled',true);
            $( "#alterdata :input[type='text'],input[type='email']" ).each(function() {
              var $this = $(this);
              $this.attr("placeholder", $this.attr("value")).removeAttr("value");
            });
          } else {
            $( "#submiter" ).prop('disabled',false);
            $( "#alterdata :input" ).prop('disabled',false);
            $( "#alterdata :input[type='text'],input[type='email']" ).each(function() {
              var $this = $(this);
              $this.attr("value", $this.attr("placeholder")).removeAttr("placeholder");
            });
          }
        });
      });
      function unlock() {
        button = document.getElementById('submiter');
        console.log("test");
        if (button.disabled == true) {
          button.disabled = false;
          document.getElementById('email').removeAttribute('disabled');
        } else {
          button.disabled = true;
          document.getElementById('email').disabled = true;
        }
      }
    </script>
     <link href="css/bootstrap.css" rel="stylesheet">
     <link href="js/bootstrap.js" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="index.css?v=xkl)Xip/t|=7s3x">
     </head>
     <body>
       <?php
       session_start();
       if ($_SESSION['user'] == "unloged") {
         header("Location: index.php");
       } else {
       $connection = new mysqli("localhost", "root", "Alvaro", "tienda");

       //TESTING IF THE CONNECTION WAS RIGHT
       if ($connection->connect_errno) {
           printf("Connection failed: %s\n", $connection->connect_error);
           exit();
       }
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
          echo "<a class='btn btn-primary' href='productcreator.php'>Product management</a>";
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
           <div class="col-md-12" id="content">
             <div class="col-md-6" id="personalinfo">
               <form id="registerform" method="POST" onSubmit="return validationPass()" action="dataupdate.php">
                 <fieldset>
                   <legend>Personal information:</legend>
                     <div class="form-group" id="alterdata">
                       <br />
                       <label for="email">Email address</label>
                       <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo "$obj->email";?>" disabled>
                       <br />
                       <label for="password">New password</label>
                       <input type="password" name="password" class="form-control" id="password" placeholder="New password" disabled>
                       <br />
                       <label for="password2">Confirm new password</label>
                       <input type="password" name="password2" class="form-control" id="password2" placeholder="Confirm new password" disabled>
                       <br />
                       <label for="name1">Name</label>
                       <input type="text" name="name" class="form-control" id="name1" placeholder="<?php echo "$obj->name";?>" disabled>
                       <br />
                       <label for="surname">Surnames</label>
                       <input type="text" name="surname" class="form-control" id="surname" placeholder="<?php echo "$obj->surname";?>" disabled>
                       <br />
                       <label for="address">Address</label>
                       <input type="text" name="address" class="form-control" id="address" placeholder="<?php echo "$obj->address";?>" disabled>
                       <br />
                       <label for="passwordold">Actual password</label>
                       <input required type="password" name="passwordold" class="form-control" id="passwordold" placeholder="Original password" disabled>
                     </div><br/>
                       <button type="submit" value="register" class="btn btn-primary" id="submiter" disabled>Save changes</button>
                       <button type="button" id="toggler" class="btn btn-primary">Edit personal information</button>
                  </fieldset>
               </form>
             </div>
             <div class="col-md-6" id="oldorders">
               <form id="registerform" method="POST" >
                 <fieldset>
                   <legend>Orders:</legend>
                     <div class="form-group">
                       <br />
                       <label for="email">Placeholders</label>
                       <input type="email" name="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                       <br />
                       <label for="passowrd">Password</label>
                       <input required type="password" name="password" class="form-control" placeholder="Password">
                       <br />
                       <label for="password2">Confirm password</label>
                       <input required type="password" name="password2" class="form-control" placeholder="Password2">
                       <br />
                       <label for="name1">Name</label>
                       <input required type="text" name="name" class="form-control"  placeholder="Manolo">
                       <br />
                       <label for="surname">Surnames</label>
                       <input required type="text" name="surname" class="form-control" placeholder="El del Bombo">
                       <br />
                       <label for="address">Address</label>
                       <input required type="text" name="address" class="form-control" placeholder="Sevilla C/ Piruleta 123">
                     </div><br/>
                       <button type="submit" value="register" class="btn btn-primary">Save changes</button>
                  </fieldset>
               </form>
             </div>
             <div class="cl-md-6" id="orders">

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

          <script type="text/javascript" src="js/bootstrap.min.js">
          </script>
          <script type="text/javascript" src="js/check.js">
          </script>



     </body>
 </html>
