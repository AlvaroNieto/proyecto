<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.js">
    </script>
    <script>
    </script>
  </head>
  <body>
    <?php
    include_once("controlpanel.php");
    session_start();
    if ($_SESSION['type'] !== "admin") {
      header("Location: index.php");
    } else {
    include_once("php/connection.php");

    if ($result = $connection->query("SELECT * FROM item ORDER BY REFERENCE DESC")) {
      echo '
        <div class="panel panel-primary filterable">
              <div class="panel-heading">
                  <h3 class="panel-title">Messages</h3>
              </div>
              <table class="table">
                  <tbody>';
                    echo '<form action="php/edit.php" method="POST">';
                    echo "<tr>
                          <td><p>Para enviar el mensaje a todos los usuarios pon como destinatario 'all'.</p> <input type='text' class='form-control' name='nick' placeholder='Nick del usuario al que enviar el mensaje.' rquiered></td>
                          <td><textarea class='form-control' type='text' rows='6' cols='50' name='content' placeholder='Contenido del mensaje.' required></textarea></td>
                          <td><button name='sender' style='margin-top:15px;' class='btn btn-primary'>Enviar</button>
                          </form></td>
                      </tr>";
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
