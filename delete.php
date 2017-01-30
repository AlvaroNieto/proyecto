<?php
session_start();
if ($_SESSION['type'] !== "admin") {
  header("Location: index.php");
} else {
  $connection = new mysqli("localhost", "root", "Alvaro", "tienda");
  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }
  $sql="SELECT pic FROM item where `reference` = ".$_POST['val'].";";
  if ($result = $connection->query($sql)) {
    $obj = $result->fetch_object();
    unlink($obj->pic);
  } else {
    echo "something went wrong";
  }
  $result->close();
  $sql="DELETE FROM `item` WHERE `item`.`reference` = ".$_POST['val'].";";
  if ($result = $connection->query($sql)) {
    header("Location: productcreator.php");
  } else {
    echo "something went wrong";
  }
}
 ?>
