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
  if (isset($_POST['val'])) {
    $sql="SELECT pic FROM item where `reference` = ".$_POST['val'].";";
    if ($result = $connection->query($sql)) {
      $obj = $result->fetch_object();
      unlink($obj->pic);
    } else {
      echo "something went wrong";
    }
    $result->close();
    $sql="DELETE FROM `item` WHERE `reference` = ".$_POST['val'].";";
    if ($result = $connection->query($sql)) {
      header("Location: productcreator.php");
    } else {
      echo "something went wrong";
    }
  } else {
    $sql="DELETE FROM `users` WHERE `id` = ".$_POST['user'].";";
    if ($result = $connection->query($sql)) {
      header("Location: usermanagement.php");
    } else {
      echo "something went wrong";
      var_dump($sql);
    }
  }
}
 ?>
