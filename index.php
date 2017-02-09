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
    $sql2="select pic from item";
    $result2 = $connection->query($sql2);
    $n=1;
    while ($obj2 = $result2->fetch_object()) {
      ${"image".$n}=$obj2->pic;
      $n++;
    }
    function buttons() {
      global $connection;
      $sql="select * from category;";
      $result = $connection->query($sql);
      while ($obj = $result->fetch_object()) {
        $sql1="select * from subcategory where category_id=$obj->category_id;";
        $result1 = $connection->query($sql1);
        echo '<div class="dropdown itemdrop">
          <button class="btn btn-default dropdown-toggle items" type="button" id="menu1" data-toggle="dropdown">'.$obj->category_name.'
          <span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">';
          while ($obj1 = $result1->fetch_object()) {
            echo '<li role="presentation">
                    <a role="menuitem" tabindex="-1" href="#">'.$obj1->subcategory_name.'</a></li>
              </ul>
            </div>';
          }
      }
    }

     ?>
     $(function() {
       var imagen = new Array(4)
       imagen[1]="<?php echo "$image1" ?>"
       imagen[2]="<?php echo "$image2" ?>"
       imagen[3]="<?php echo "$image3" ?>"
       imagen[4]="<?php echo "$image2" ?>"
       var num = 1;
       var salto = new Array(4)
       salto[1]=salto1
       salto[2]=salto2
       salto[3]=salto3
       salto[4]=salto4
       $("#salto1").css("background-color","white");
       $("#adelante").click(function() {
         $("#adelante").clearQueue();
         num=num+1 //Sumar un valor a la valiable
         if (num==5) //Bucle en caso de dar la vuelta completa a la galeria
         {num=1}
         $(".saltos").css("background-color",""); //Quitar cualquier boton directo
         $(salto[num]).css("background-color","white"); //Cambiar el color del boton al que corresponde la imagen
         $("salto")
         $("#foto").fadeTo("slow",0); //Desvanecer imagen
         $("#foto").delay(100) //Delay para que la imagen no cambiar automaticamente
         .queue(function(next) { $(this).attr("src",imagen[num]); next(); }); //cambiar el valor del src de la imagen por la variable imagen + num
         $("#foto").fadeTo("slow",1); //Mostrar imagen cambiada
       });
       $("#atrasq").click(function() { //Igual pero hacia atras
         num=num-1
         if (num==0)
         {num=4}
         $(".saltos").css("background-color","");
         $(salto[num]).css("background-color","white");
         $("#foto").fadeTo("slow",0);
         $("#foto").delay(100)
          .queue(function(next) { $(this).attr("src",imagen[num]); next(); });
         $("#foto").fadeTo("slow",1);
       });
         $("#adelante,#atras").mouseenter(function() { //Cambiar estilo de los botones al pasar el raton
           $(this).css("border-top","3px solid white")
           .css("border-right","3px solid white")
           .css("border-radius", "8px");
         }).mouseleave(function() {
           $(this).css("border-top","3px solid #494949")
           .css("border-right","3px solid #494949")
           .css("border-radius", "0px");
         });
         //Selector de foto
         $(".saltos").click(function() {
           var index = $(this).index();
           num=index-2
           $(".saltos").css("background-color","");
           $("#foto").fadeTo("slow",0);
           $("#foto").delay(100)
           .queue(function(next) { $(this).attr("src",imagen[num]); next(); });
           $("#foto").fadeTo("slow",1);
           $(this).css("background-color","white");
           });
       });
    </script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js">
    <link rel="stylesheet" type="text/css" href="index.css?v=0xkl)Xip/t|=7s3x">
    </head>
    <body>
      <?php
      session_start();
      var_dump($_SESSION);
      var_dump($_POST);
      if ($_SESSION == NULL) {
        $_SESSION["user"]= "unloged";
      }

      ?>


     <div class="container">
       <?php
       if ($_SESSION["type"] == "admin") {
         echo "<a class='btn btn-primary' href='productcreator.php'>Product management</a>";
         echo "<a class='btn btn-primary' href='usermanagement.php'>Users management</a>";
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
            <legend>Diésel:</legend>
              <?php
              buttons($connection);
               ?>
            <fieldset>
               <legend>Gasoil:</legend>
               <?php
               buttons($connection);
                ?>
            </fieldset>
            <fieldset>
              <legend>Gasolina:</legend>
              <?php
              buttons($connection);
               ?>
           </fieldset>
           <fieldset>
             <legend>Eléctrico:</legend>
             <?php
             buttons($connection);
             ?>
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
            <div id="menucontainer">
             <img src="images/multipla.jpg" id="foto">
             <i id="adelante" class="arrow"></i>
             <i id="atras" class="arrow arrow-left"></i>
             <div id="salto1" class="saltos"></div>
             <div id="salto2" class="saltos"></div>
             <div id="salto3" class="saltos"></div>
             <div id="salto4" class="saltos"></div>
           </div>
           <div class="container" id="highlights">
              <div id="products" class="row list-group">
                  <div class="item  col-xs-5 col-lg-5">
                      <div class="thumbnail">
                          <img class="group list-group-image" src="images/original.jpg" alt="" />
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
                                      <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="item  col-xs-5 col-lg-5">
                      <div class="thumbnail">
                          <img class="group list-group-image" src="images/multipla.jpg" alt="" />
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
                                      <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
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
        <?php

         ?>

         <script type="text/javascript" src="js/bootstrap.min.js">
         </script>
         <script type="text/javascript" src="js/check.js">
         </script>
    </body>
</html>
