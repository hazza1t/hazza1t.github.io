<?php
session_start();
      // Get some session data.
    echo $_SESSION["username"];
    // Update some session data.
    //$_SESSION[“data”] = query(“SELECT * FROM $table2;”);
    // Remove some session data.
    if (isset($_SESSION["password"])) {
    unset($_SESSION["password"]);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Record your Injury</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">

        </style>
    </head>

    <body>
      <h1>Record your injury</h1>

      <form action="record.php" method="post">
        Injury Type: <input type='text' name='type'><br><br>
        Cause of Injury: <input type='text' name='cause'><br><br>
        Severity of Injury: <input type='text' name='severity'><br><br>
        Symptoms: <input type='text' name='symptoms'><br><br>
        <input name='action' type='submit' value='Record'>
        <a href="logout.php"><button>Logout</button></a>
      </form>






        <script>

        </script>
    </body>
</html>
