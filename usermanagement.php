<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.js">
    </script>
    <script>
    $(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') === true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        $('.no-result').remove();
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).find('input').val().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */

        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length == $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
    </script>
    <style>
    table {
      border-collapse: collapse;
      margin: 0 auto;
    }
    input[type="text"] {
      width: 80%;
    }
    input[type="number"] {
      width: 60%
    }
    img {
      width: 105px;
    }
    td {
      vertical-align:middle !important;
    }
    tbody > tr:hover {
      background-color: DarkGrey;
    }
    .filterable {
    margin-top: 15px;
    }
    .filterable .panel-heading .pull-right {
        margin-top: -20px;
    }
    .filterable .filters input[disabled] {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }
    .filterable .filters input[disabled]::-webkit-input-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]::-moz-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]:-ms-input-placeholder {
        color: #333;
    }
    #deleter {
      display: inline;
    }
    td {
      padding: 8px;
    }
    </style>
  </head>
  <body>
    <a class='btn btn-primary' href='index.php'>Home</a>
    <a class='btn btn-primary' href='productcreator.php'>Product management</a>
    <a class='btn btn-primary' href='usermanagement.php'>Users management</a><br><br>
    <?php
    session_start();
    if ($_SESSION['type'] !== "admin") {
      header("Location: index.php");
    } else {
    include_once("connection.php");
    if ($result = $connection->query("SELECT * FROM users")) {
      echo '
        <div class="panel panel-primary filterable">
              <div class="panel-heading">
                  <h3 class="panel-title">Products</h3>
                  <div class="pull-right">
                      <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                  </div>
              </div>
              <table class="table">
                  <thead>
                      <tr class="filters">
                          <th><input type="text" class="form-control" placeholder="Nick" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Password" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Address" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Type" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Surname" disabled></th>
                      </tr>
                  </thead>
                  <tbody>
                  <form action="edit.php" method="post">';
        while($obj = $result->fetch_object()) {
          if ($obj->type !== 'admin') {
            $usertype = 'user';
            $usernotype = 'admin';
          } else {
            $usertype = 'admin';
            $usernotype = 'user';
          }
            /*echo "<form action='edit.php' method='post'>";
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



          */

                        echo '<form action="edit.php" method="post">';
                        echo "<tr>
                              <td><input type='text' class='form-control' name='nick$obj->id' value='$obj->nick'>
                              </td>
                              <td><input type='text' class='form-control' name='email$obj->id' value='$obj->email'>
                              </td>
                              <td><input type='text' class='form-control' name='password$obj->id' value=''></td>
                              <td><input type='text' class='form-control' name='address$obj->id' value='$obj->address'></td>
                              <td><SELECT class='form-control' NAME='type' SIZE='1'>
                                       <OPTION VALUE='$usertype'>$usertype</OPTION>
                                       <OPTION VALUE='$usernotype'>$usernotype</OPTION>
                                    </SELECT></td>
                              <td><input type='text' class='form-control' name='name$obj->id' value='$obj->name'></td>
                              <td><input type='text' class='form-control' name='surname$obj->id' value='$obj->surname'>
                              <button name='user' style='margin-top:15px; width: 48px;' class='btn btn-primary' value=$obj->id><i class='glyphicon glyphicon-edit'></i></button>
                              </form><form method='POST' id='deleter' action='delete.php'><button name='user' class='btn btn-primary' style='margin-top:15px; width: 48px;' value=$obj->id>
                              <i class='glyphicon glyphicon-trash'></i></button></td></form></td>

                          </tr>";
                      }

                      echo '
                      </tbody>
                  </table>
              </div>';
        }
    }
    ?>

    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
  </body>
</html>
