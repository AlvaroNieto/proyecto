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
  <body style='min-height:900px'>
    <?php
    include_once("controlpanel.php");
    session_start();
    if ($_SESSION['type'] !== "admin") {
      header("Location: index.php");
    } else {
    include_once("php/connection.php");

    echo "Upload single image file";
    echo "<form action='php/imageupload.php' method='post' enctype='multipart/form-data'>";
    echo "<input type='file' name='imageToUpload' id='imageToUpload'><button>Upload</button></form>";
    echo "<form action='php/upload.php' method='post' enctype='multipart/form-data'>";
    echo "<br><br>Create item";
    echo "<br> <table style='border:1px solid black'>";
    echo "<tr>";
      echo "<td><input class='form-control' placeholder='name' type='text' name='name'></td>";
      echo "<td><input class='form-control' placeholder='value' type='number' name='value'></td>";
      echo "<td><input class='form-control' placeholder='chassis' type='text' name='chassis'></td>";
      echo "<td><input class='form-control' placeholder='transmission' type='text' name='transmission'></td>";
      echo "<td><input class='form-control' placeholder='traction' type='text' name='traction'></td>";
      echo "<td><input class='form-control' placeholder='type' type='text' name='type'></td>";
    echo "</tr><tr>";
      echo "<td></td>";
      echo "<td colspan='2'><textarea class='form-control' rows='4' cols='50' placeholder='description' type='text' name='description'></textarea></td>";
      echo "<td colspan='2'><textarea class='form-control' rows='8' cols='50' placeholder='description_long' type='text' name='description_long'></textarea></td>";
      echo "<td></td>";
    echo "</tr><tr>";
      echo "<td colspan='1'><input class='form-control' placeholder='stock' type='number' name='stock'></td>";
      echo "<td colspan='3'><input class='form-control' type='file' name='fileToUpload' id='fileToUpload'></td>";
      echo "<td></td>";
      echo "<td colspan='1'><input class='form-control' type='submit'></td>";
    echo "</tr>";
    echo "</table> ";
    echo "</form>";

    if ($result = $connection->query("SELECT * FROM item ORDER BY REFERENCE DESC")) {
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
                          <th><input type="text" class="form-control" placeholder="name" disabled></th>
                          <th><input type="text" class="form-control" placeholder="value" disabled></th>
                          <th><input type="text" class="form-control" placeholder="chassis" disabled></th>
                          <th><input type="text" class="form-control" placeholder="traction" disabled></th>
                          <th><input type="text" class="form-control" placeholder="transmission" disabled></th>
                          <th><input type="text" class="form-control" placeholder="type" disabled></th>
                          <th>Description</th>
                          <th><input type="text" class="form-control" placeholder="picture" disabled></th>
                          <th><input type="text" class="form-control" placeholder="stock" disabled></th>
                      </tr>
                  </thead>
                  <tbody>
                  <form action="php/edit.php" method="post">';
                  while($obj = $result->fetch_object()) {
                    echo '<form action="php/edit.php" method="post">';
                    echo "<tr>
                          <td><input type='text' class='form-control' name='name$obj->reference' value='$obj->name'>
                          </td>
                          <td><input type='text' class='form-control' name='value$obj->reference' value='$obj->value'>
                          </td>
                          <td><input type='text' class='form-control' name='chassis$obj->reference' value='$obj->chassis'></td>
                          <td><input type='text' class='form-control' name='traction$obj->reference' value='$obj->traction'></td>
                          <td><input type='text' class='form-control' name='transmission$obj->reference' value='$obj->transmission'></td>
                          <td><input type='text' class='form-control' name='type$obj->reference' value='$obj->type'></td>
                          <td><a href='description_manager.php?name=$obj->name' style='text-align: center' class='form-control'><i class='glyphicon glyphicon-edit'></i></a></td>
                          <td><img src=".$obj->pic."></img><input type='text' class='form-control' name='pic' value='$obj->pic'></td>
                          <td><input type='text' class='form-control' name='stock$obj->reference' value='$obj->stock' >
                          <button name='val' style='margin-top:15px; width: 48px;' class='btn btn-primary' value=$obj->reference><i class='glyphicon glyphicon-edit'></i></button>
                          </form><form method='POST' id='deleter' action='php/delete.php'><button name='val' class='btn btn-primary' style='margin-top:15px; width: 48px;' value=$obj->reference>
                          <i class='glyphicon glyphicon-trash'></i></button></td></form></td>

                      </tr>";
                  }

                  echo '
                  </tbody>
              </table>
          </div>';
        }
    }
    unset($connection);
    ?>
    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
  </body>
</html>
