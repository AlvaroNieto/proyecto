<?php
session_start();
$error = false;
if (isset($_SESSION["type"])) {
  $connection = new mysqli("localhost", "root", "Alvaro", "tienda");
  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }
  if ($_SESSION["user"] != NULL && $_POST['passwordold'] != NULL) {
    $sql="select * from users where
    nick='".$_SESSION["user"]."' and password=md5('".$_POST["passwordold"]."');";

    if ($result = $connection->query($sql)) {
      if ($result->num_rows==0) {
        echo "Wrong password";
      } else {
        foreach ($_POST as $key => $value) {
          if ($key !== "passwordold" and $key !== "password2") {
            if ($key == "password") {
              $value=md5("$value");
            }
            if (isset($_POST["$key"]) && !empty($_POST["$key"])) {
              $sql = "UPDATE `users` SET `$key` =
              '".$value."' WHERE `users`.`nick` = '".$_SESSION["user"]."';";
              if ($result = $connection->query($sql)) {
                if ($result!==true) {
                  echo "Ops... something went wrong";
                  $error = true;
                }
              } else {
                 echo "Wrong Query";
                 var_dump($sql);
                 $error = true;
              }
            }
          }
        }
          if ($error == false ) {
            echo "Data updated. Returning to your profile...";
            header( "refresh:2; url=profile.php" );
          }
         }
        } else {
          echo "Wrong Query";
          var_dump($sql);
       }
     }
  }
 ?>
