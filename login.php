<?php
if(isset($_POST["user"])){
  $username = $_POST['user'];
  $password = md5($_POST['password']);
}
include_once("connection.php");
if ($username != NULL && $password != NULL) {
  $sql="select * from users where
  nick='".$_POST["user"]."' and password=md5('".$_POST["password"]."');";

  if ($result = $connection->query($sql)) {
    if ($result->num_rows==0) {
      echo "Login invalido";
      $_SESSION="";
    } else {
        //VALID LOGIN. SETTING SESSION VARS
        session_start();
        $_SESSION["user"]=$_POST["user"];
        $obj = $result->fetch_object();
        $_SESSION["type"]=$obj->type;
        header("Location: index.php");
      }

    } else {
      echo "Wrong Query";
      var_dump($sql);
  }
}
?>
