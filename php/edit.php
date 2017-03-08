<?php
session_start();
//var_dump($_POST);
$error = false;
if ($_SESSION['type'] !== "admin") {
  header("Location: ../index.php");
} else {
  include_once("connection.php");
  if (isset($_POST['val'])) {
    $id=$_POST['val'];
      $sql="UPDATE `item` SET `name` = '".$_POST['name'."$id"]."', `value` = '".$_POST['value'."$id"]."',
       `chassis` = '".$_POST['chassis'."$id"]."',
       `transmission` = '".$_POST['transmission'."$id"]."',
       `type` = '".$_POST['type'."$id"]."',
       `traction` = '".$_POST['traction'."$id"]."',
       `stock` = '".$_POST['stock'."$id"]."',
       `pic` = '".$_POST['pic']."'
        WHERE `item`.`reference` = '".$_POST['val']."';";
      if ($result = $connection->query($sql)) {
        echo "Data updated. Returning...";
        header( "refresh:1; url=../productcreator.php" );
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
        header( "refresh:1; url=../usermanagement.php" );
      } else {
        echo "something went wrong";
        var_dump($sql);
      }
    }
    if(isset($_POST['description'])) {
      $id=$_POST['editor'];
        $sql="UPDATE `item` SET `name` = '".$_POST['name']."',
         `description` = '".$_POST['description']."',
         `description_long` = '".$_POST['description_long']."'
          WHERE `item`.`reference` = '".$_POST['editor']."';";
        if ($result = $connection->query($sql)) {
          echo "Data updated. Returning...";
          $namer = $_POST['name'];
          header( "refresh:1; url=../description_manager.php?name=$namer" );
        } else {
          echo "something went wrong";
          var_dump($sql);
        }
    }
    if(isset($_POST['sender'])) {
      $id=$_POST['editor'];
        $sql1 = "SELECT * FROM `users` where nick = '".$_POST['nick']."'";
        $result = $connection->query($sql1);
        $obj = $result->fetch_object();
        $id = $obj->id;
        $sql="INSERT INTO `messages` (`mid`, `users.id`, `message`) VALUES (NULL, '$id','".$_POST['content']."')";
        if ($result = $connection->query($sql)) {
          echo "Message sent. Returning...";
          header( "refresh:1; url=../sendmessages.php" );
        } else {
          echo "Something went wrong <br/> Check if the user exists <br/>";
          echo "<a class='btn btn-primary btn-xs'
          href='../usermanagement.php' style='margin-right: 5px'>Users management</a><br/>";
          var_dump($sql);
        }
    }
  }
  unset($connection);
 ?>
