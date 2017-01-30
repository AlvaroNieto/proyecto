<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
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
      width: 60%
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
    </style>
  </head>
  <body>

    <?php
    session_start();
    if ($_SESSION['type'] !== "admin") {
      header("Location: index.php");
    } else {
    $connection = new mysqli("localhost", "root", "Alvaro", "tienda");
    echo "<a href='index.php'>Home</a><br><br>";
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
          <th>Category</th>
          <th>Subcategory</th>
          <th>Description</th>
          <th>stock</th>
          <th>Picture</th>
          <th>Upload</th>
      </thead>";
    echo "<tr>";

      echo "<td><input type='text' name='name'></td>";
      echo "<td><input type='number' name='value'></td>";
      echo "<td><input type='text' name='category'></td>";
      echo "<td><input type='text' name='subcategory'></td>";
      echo "<td><input type='text' name='description'></td>";
      echo "<td><input type='number' name='stock'></td>";
      echo "<td><input type='file' name='fileToUpload' id='fileToUpload'></td>";
      echo "<td><input type='submit'></td>";
    echo "</tr>";
    echo "</table> ";
    echo "</form>";
    //Comienzo para la tabla empleados.
    echo "<form action='edit.php' method='post'>";
    echo "<br> <table style='border:1px solid black'>

      <thead>
        <tr>
          <th>Name</th>
          <th>Value</th>
          <th>Category</th>
          <th>Subcategory</th>
          <th>Description</th>
          <th>stock</th>
          <th>Picture</th>
          <th>Edit/Remove</th>
      </thead>";
    //TESTING IF THE CONNECTION WAS RIGHT
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    if ($result = $connection->query("SELECT * FROM item")) {
        while($obj = $result->fetch_object()) {
            echo "<tr>";
            echo "<td><input type='text' name='name' value=$obj->name></td>";
            echo "<td><input type='number' name='value' value=$obj->value></td>";
            echo "<td><input type='text' name='category' value=$obj->category></td>";
            echo "<td><input type='text' name='subcategory' value=$obj->subcategory></td>";
            echo "<td><input type='text' name='description' value=$obj->description></td>";
            echo "<td><input type='number' name='stock' value=$obj->stock ></td>";
            echo "<td><img src=".$obj->pic."></img><input type='text' name='pic' value=$obj->pic></td>";
            echo "<td><button name='val' value=$obj->reference>Edit</button></form>
            <form method='POST' action='delete.php'><button name='val' value=$obj->reference>Remove</button></td></form>";
            echo "</tr>";

          }
          echo "</table> ";
          $result->close();
          unset($obj);




        }
    }
    ?>

  </body>
</html>
