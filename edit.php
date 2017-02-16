<?php
session_start();
//var_dump($_POST);
$error = false;
if ($_SESSION['type'] !== "admin") {
  header("Location: index.php");
} else {
  $connection = new mysqli("localhost", "root", "Alvaro", "tienda");
  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }
  if (isset($_POST['val'])) {
    $id=$_POST['val'];
      $sql="UPDATE `item` SET `name` = '".$_POST['name'."$id"]."', `value` = '".$_POST['value'."$id"]."',
       `chassis` = '".$_POST['chassis'."$id"]."',
       `transmission` = '".$_POST['transmission'."$id"]."',
       `type` = '".$_POST['type'."$id"]."',
       `traction` = '".$_POST['traction'."$id"]."',
       `description` = '".$_POST['description'."$id"]."',
       `stock` = '".$_POST['stock'."$id"]."',
       `pic` = '".$_POST['pic']."'
        WHERE `item`.`reference` = '".$_POST['val']."';";
      if ($result = $connection->query($sql)) {
        echo "Data updated. Returning...";
        header( "refresh:1; url=productcreator.php" );
      } else {
        echo "something went wrong";
        var_dump($sql);
      }
   }
  if (isset($_POST['user'])) {
      $id=$_POST['user'];
      $sql="UPDATE `users` SET `nick` = '".$_POST['nick'."$id"]."',
       `email` = '".$_POST['email'."$id"]."',
       `type` = '".$_POST['type']."',
       `address` = '".$_POST['address'."$id"]."',
       `name` = '".$_POST['name'."$id"]."',
       `surname` = '".$_POST['surname'."$id"]."' WHERE `id` = '".$_POST['user']."';";
      if ($result = $connection->query($sql)) {
        if ($_POST['password'."$id"]!==''){
          $sql="UPDATE `users` SET
           `password` = md5('".$_POST['password'."$id"]."')
          WHERE `id` = '".$_POST['user']."';";
          $result=$connection->query($sql);
        }
        echo "Data updated. Returning...";
        header( "refresh:1; url=usermanagement.php" );
      } else {
        echo "something went wrong";
        var_dump($sql);
      }
    }
  }
 ?>
