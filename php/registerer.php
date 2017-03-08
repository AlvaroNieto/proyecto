<?php
if (isset($_POST['username'])) {
  include_once("connection.php");
  $sql="select * from users where
  nick='".$_POST["username"]."';";

  if ($result = $connection->query($sql)) {
    if ($result->num_rows==0) {
      $sql="select * from users where
      email='".$_POST["email"]."';";
      if ($result = $connection->query($sql)) {
        if ($result->num_rows==0) {
          $sql="INSERT INTO `users` (`id`, `nick`, `email`, `password`,
             `address`, `type`, `name`, `surname`) VALUES
             (NULL,'".$_POST["username"]."' , '".$_POST["email"]."' ,
             md5('".$_POST["password"]."'), '".$_POST["address"]."' , 'user',
             '".$_POST["name"]."' , '".$_POST["surname"]."' );";
             if ($result = $connection->query($sql)) {
               if ($result==true) {
                 session_start();
                 $last_id = $connection->insert_id;
                 $_SESSION["user"]=$_POST["username"];
                 $_SESSION["type"]="user";
                 $_SESSION["id"]=$last_id;
                 header("Location: ../index.php");
               } else {
                 echo "something went wrong";
               }
             }
          } else {
              echo "email is already registered";
              }
        } else {
            echo "Wrong Query";
            var_dump($sql);
            }
      } else {
          echo "username is already registered";
        }
  } else {
      echo "Wrong Query";
      var_dump($sql);
    }
  }
  unset($connection);
 ?>
