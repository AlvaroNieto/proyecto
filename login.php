<?php
if(isset($_POST["user"])){
  $username = $_POST['user'];
  $password = md5($_POST['password']);
}
$connection = new mysqli("localhost", "root", "Alvaro", "tienda");

//TESTING IF THE CONNECTION WAS RIGHT
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
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

 //var_dump("-->".$_POST['remember']."<--");
 //if($_POST['remember'] !== "rememberme") {
 //   session_destroy();
 //}

 //var_dump($_SESSION);
 //session_destroy();
?>
