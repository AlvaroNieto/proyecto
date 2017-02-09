<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js" rel="stylesheet">
    <style>
    table {
      border-collapse: collapse;
      margin: 0 auto;
    }
    tr {
      text-align: center;
      border: 0px;
    }
    thead {
      border: 1px solid black;
    }
    input[type="text"] {
      width: 80%;
    }
    input[type="number"] {
      width: 60%
    }
    img {
      width: 100px;
    }
    tbody > tr:hover {
      background-color: DarkGrey;
    }
    th {
      text-align: center;
    }
    td {
      height: 60px !important;
    }
    </style>
  </head>
  <body>
    <a class='btn btn-primary' href='index.php'>Home</a>
    <a class='btn btn-primary' href='usermanagement.php'>Users management</a><br><br>
    <?php
    session_start();
    if ($_SESSION['type'] !== "admin") {
      header("Location: index.php");
    } else {
    $connection = new mysqli("localhost", "root", "Alvaro", "tienda");
    echo "Upload single image file";
    echo "<form action='imageupload.php' method='post' enctype='multipart/form-data'>";
    echo "<input type='file' name='imageToUpload' id='imageToUpload'><button>Upload</button></form>";
    echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
    echo "<br><br>Create item";
    echo "<br> <table style='border:1px solid black'>
      <thead>
        <tr>
          <th>Name</th>
          <th>Value</th>
          <th>Chassis</th>
          <th>Transmission</th>
          <th>Traction</th>
          <th>Type</th>
          <th>Description</th>
          <th>stock</th>
          <th>Picture</th>
          <th>Upload</th>
      </thead>";
    echo "<tr>";

      echo "<td><input type='text' name='name'></td>";
      echo "<td><input type='number' name='value'></td>";
      echo "<td><input type='text' name='chassis'></td>";
      echo "<td><input type='text' name='transmission'></td>";
      echo "<td><input type='text' name='traction'></td>";
      echo "<td><input type='text' name='type'></td>";
      echo "<td><input type='text' name='description'></td>";
      echo "<td><input type='number' name='stock'></td>";
      echo "<td><input type='file' name='fileToUpload' id='fileToUpload'></td>";
      echo "<td><input type='submit'></td>";
    echo "</tr>";
    echo "</table> ";
    echo "</form>";
    //Comienzo para la tabla empleados.


    //TESTING IF THE CONNECTION WAS RIGHT
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    if ($result = $connection->query("SELECT * FROM item")) {
        while($obj = $result->fetch_object()) {
            echo "<form action='edit.php' method='post'>";
            echo "<br> <table style='border:1px solid black'>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Value</th>
                  <th>Chassis</th>
                  <th>Traction</th>
                  <th>Transmission</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th>stock</th>
                  <th>Picture</th>
                  <th>Edit/Remove</th>
              </thead>";
            echo "<tr>";
            echo "<td><input type='text' name='name$obj->reference' value='$obj->name'></td>";
            echo "<td><input type='number' name='value$obj->reference' value='$obj->value'></td>";
            echo "<td><input type='text' name='chassis$obj->reference' value='$obj->chassis'></td>";
            echo "<td><input type='text' name='traction$obj->reference' value='$obj->traction'></td>";
            echo "<td><input type='text' name='transmission$obj->reference' value='$obj->transmission'></td>";
            echo "<td><input type='text' name='type$obj->reference' value='$obj->type'></td>";
            echo "<td><input type='text' name='description$obj->reference' value='$obj->description'></td>";
            echo "<td><input type='number' name='stock$obj->reference' value='$obj->stock' ></td>";
            echo "<td><img src=".$obj->pic."></img><input type='text' name='pic' value='$obj->pic'></td>";
            echo "<td><button name='val' value=$obj->reference>Edit</button></form>
            <form method='POST' action='delete.php'><button name='val' value=$obj->reference>Remove</button></td></form>";
            echo "</tr>";
            echo "</table> ";
          }

          $result->close();
          unset($obj);




        }
    }
    ?>

    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
  </body>
</html>
