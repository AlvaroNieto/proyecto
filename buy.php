<?php
session_start();
if ($_SESSION['user'] == "unloged") {
  header("Location: index.php");
}
$prize=0;
$ok="ok";
include_once("connection.php");
foreach ($_GET as $key => $value) {
  $sql="SELECT * FROM ITEM WHERE REFERENCE = $key";
  $result = $connection->query($sql);
  $obj = $result->fetch_object();
  $prize=$prize + ($obj->value*$value);
}

$sql = 'SELECT * FROM USERS WHERE NICK = "'.$_SESSION['user'].'"';
$result = $connection->query($sql);
$obj = $result->fetch_object();
$id=$obj->id;
$sql="INSERT INTO `cart` (`oid`, `value`, `date`, `users.id`) VALUES
   (NULL,'".$prize."', curdate(), '".$id."')";
if ($result = $connection->query($sql)) {
   if ($result==true) {
     $last_id = $connection->insert_id;
     $last_id;
     foreach ($_GET as $key => $value) {
       $sql="INSERT INTO `quantity` (`item.reference`, `cart.oid`, `quantity`) VALUES
          ('".$key."','".$last_id."','".$value."')";

       $result1 = $connection->query($sql);
         if ($result1!==true) {
            $ok="false";
        }
      }
      if ($ok==ok) {
        echo "Comprado. volviendo a tu perfil...";
        header( "refresh:2; url=profile.php" );
        unset($_SESSION['cartadd']);
      }
   } else {
     echo "something went wrong";
   }
}
?>
