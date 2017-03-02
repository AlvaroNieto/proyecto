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
    <?php
    include_once("controlpanel.php");
    session_start();
    if ($_SESSION['type'] !== "admin") {
      header("Location: index.php");
    } else {
    include_once("connection.php");
    if ($result = $connection->query("SELECT * FROM cart ORDER BY oid DESC")) {
      echo '
        <div class="panel panel-primary filterable">
              <div class="panel-heading">
                  <h3 class="panel-title">Carts</h3>
                  <div class="pull-right">
                      <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                  </div>
              </div>
              <table class="table">
                  <thead>
                      <tr class="filters">
                          <th><input type="text" class="form-control" placeholder="Bought by" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Value" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                          <th><input type="text" class="form-control" placeholder="Products" disabled></th>
                      </tr>
                  </thead>
                  <tbody>
                  <form action="edit.php" method="post">';
        while($obj = $result->fetch_object()) {
          $id=$obj->{'users.id'};
          $sql2 = "SELECT * FROM USERS WHERE ID = '$id'";
          $result2 = $connection->query($sql2);
          $obj2 = $result2->fetch_object();
          $sql3 = "SELECT * FROM QUANTITY WHERE `cart.oid`='$obj->oid'";
          $result3 = $connection->query($sql3);
          $products = '';
          while ($obj3 = $result3->fetch_object()) {
            $ref=$obj3->{"item.reference"};
            $sql4 = "SELECT * FROM ITEM WHERE `REFERENCE` = '$ref'";
            $result4 = $connection->query($sql4);
            $obj4 = $result4->fetch_object();
            $products = "$products ".$obj3->quantity."->".$obj4->name;
          }

                        echo '<form action="edit.php" method="post">';
                        echo "<tr>
                              <td><input type='text' class='form-control' name='nick$obj->oid' value='$obj2->nick' disabled>
                              </td>
                              <td><input type='text' class='form-control' name='value$obj->oid' value='$obj->value' disabled>
                              </td>
                              <td><input type='text' class='form-control' name='date$obj->oid' value='$obj->date' disabled></td>
                              <td><textarea class='form-control' type='text' rows='3' cols='20' name='products' disabled>$products</textarea>
                              </form><form method='POST' id='deleter' action='delete.php'><button name='cart' class='btn btn-primary' style='margin-top:15px; width: 48px;' value=$obj->oid>
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
