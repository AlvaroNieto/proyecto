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
    }
    </style>
  </head>
  <body>
    <a class='btn btn-primary' href='index.php'>Home</a>
    <a class='btn btn-primary' href='productcreator.php'>Product management</a><br><br>
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

    if ($result = $connection->query("SELECT * FROM users")) {
        while($obj = $result->fetch_object()) {
          if ($obj->type !== 'admin') {
            $usertype = 'user';
            $usernotype = 'admin';
          } else {
            $usertype = 'admin';
            $usernotype = 'user';
          }
            echo "<form action='edit.php' method='post'>";
            echo "<br> <table style='border:1px solid black'>
              <thead>
                <tr>
                  <th>Nick</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Address</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Save changes</th>
              </thead>";
            echo "<tr>";
            echo "<td><input type='text' class='form-control' name='nick$obj->id' value='$obj->nick'></td>";
            echo "<td><input type='email' class='form-control' name='email$obj->id' value='$obj->email'></td>";
            echo "<td><input type='text' class='form-control' name='password$obj->id' value=''></td>";
            echo "<td><input type='text' class='form-control' name='address$obj->id' value='$obj->address'></td>";
            echo '<td><SELECT class="form-control" NAME="type" SIZE="1">
                     <OPTION VALUE='.$usertype.'>'.$usertype.'</OPTION>
                     <OPTION VALUE='.$usernotype.'>'.$usernotype.'</OPTION>
                  </SELECT> </td>';
            echo "<td><input type='text' class='form-control' name='name$obj->id' value='$obj->name'></td>";
            echo "<td><input type='text' class='form-control' name='surname$obj->id' value='$obj->surname'></td>";
            echo "<td><button name='user' value=$obj->id>Edit</button></form>
            <form method='POST' action='delete.php'><button name='user' value=$obj->id>Remove</button></td></form>";
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
