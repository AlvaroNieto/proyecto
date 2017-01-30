
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
    $sql="UPDATE `item` SET `name` = '".$_POST['name']."', `value` = '".$_POST['value']."', `category` =
    '".$_POST['category']."', `subcategory` = '".$_POST['subcategory']."', `description` =
    '".$_POST['description']."', `stock` = '".$_POST['stock']."',
     `pic` = '".$_POST['pic']."' WHERE `item`.`reference` = '".$_POST['val']."';";
    if ($result = $connection->query($sql)) {
      echo "Data updated. Returning...";
      header( "refresh:2; url=productcreator.php" );
    } else {
      echo "something went wrong";
    }
  }
 ?>
