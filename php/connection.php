<?php
$connection = new mysqli("localhost", "tienda", "Alvaro", "tienda");
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
 ?>
