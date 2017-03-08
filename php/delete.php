<?php
session_start();
include_once("connection.php");
if (isset($_GET['message'])) {
 $sql="DELETE FROM `messages` WHERE `mid` = '".$_GET['message']."'";
 if ($result = $connection->query($sql)) {
   header("Location: ../profile.php");
 } else {
   echo "something went wrong";
   var_dump($sql);
 }
}
if (isset($_GET['usercartdel'])) {
  $sql="SELECT * FROM `cart` WHERE `oid` = ".$_GET['usercartdel'].";";
  $result = $connection->query($sql);
  $obj = $result->fetch_object();
  if ($obj->{"users.id"} == $_SESSION['id']) {
    $sql="DELETE FROM `cart` WHERE `oid` = ".$_GET['usercartdel'].";";
    if ($result = $connection->query($sql)) {
      var_dump($sql);
      header("Location: ../profile.php");
    } else {
      echo "something went wrong";
      var_dump($sql);
    }
  } else {
    header("Location: ../index.php");
  }
}

if ($_SESSION['type'] !== "admin" && !isset($_GET['usercartdel']) && !isset($_GET['message'])) {
  header("Location: ../index.php");
} else {
  if (isset($_POST['val'])) {
    $sql="SELECT pic FROM item where `reference` = ".$_POST['val'].";";
    if ($result = $connection->query($sql)) {
      $obj = $result->fetch_object();
      unlink("../$obj->pic");
    } else {
      echo "something went wrong";
    }
    $result->close();
    $sql="DELETE FROM `item` WHERE `reference` = ".$_POST['val'].";";
    if ($result = $connection->query($sql)) {
      header("Location: ../productcreator.php");
    } else {
      echo "something went wrong";
      var_dump($sql);
    }
  } else if (isset($_POST['user'])) {
    $sql="DELETE FROM `users` WHERE `id` = ".$_POST['user'].";";
    if ($result = $connection->query($sql)) {
      header("Location: ../usermanagement.php");
    } else {
      echo "something went wrong";
      var_dump($sql);
    }
  } else if (isset($_POST['cart'])) {
    $sql="DELETE FROM `cart` WHERE `oid` = ".$_POST['cart'].";";
    if ($result = $connection->query($sql)) {
      header("Location: ../cartmanagement.php");
    } else {
      echo "something went wrong";
      var_dump($sql);
    }
  }
}
unset($connection);
 ?>
