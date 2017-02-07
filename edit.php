<?php
session_start();
var_dump($_POST);
$error = false;
if ($_SESSION['type'] !== "admin") {
  header("Location: index.php");
} else {
  $connection = new mysqli("localhost", "root", "Alvaro", "tienda");
  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }
  $id=$_POST['val'];
    $sql="UPDATE `item` SET `name` = '".$_POST['name'."$id"]."', `value` = '".$_POST['value'."$id"]."', `subcategory_name` = '".$_POST['subcategory'."$id"]."', `description` =
    '".$_POST['description'."$id"]."', `stock` = '".$_POST['stock'."$id"]."',
     `pic` = '".$_POST['pic']."' WHERE `item`.`reference` = '".$_POST['val']."';";
    if ($result = $connection->query($sql)) {
      echo "Data updated. Returning...";
      var_dump($sql);
      header( "refresh:2; url=productcreator.php" );
    } else {
      echo "something went wrong";
      var_dump($sql);
    }
  }
 ?>
