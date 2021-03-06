<?php
//Start the session
session_start();
require 'common.php';
//Check if session username exists, if not, sned to login page
if (!isset($_SESSION["username"])) {
  header ("Location: login.php");
}

// Get some session data.
    $seshUser = $_SESSION["username"];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Ouch</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-/ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <style type="text/css">
         table {
              border: 1px solid black;
            }
              #home{
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: lightblue;
            color: black;
            } #logout{
              position: absolute;
              bottom: 10px;
              right: 10px;
              padding: 14px 20px;
              background-color: lightcoral;
              color: black;
            } #record {
            padding: 14px 20px;
            background-color: lightgreen;
              color: black;
          } .btn-circle {
            width: 45px;
            height: 45px;
            line-height: 45px;
            text-align: center;
            padding: 0;
            border-radius: 50%;
            }
          .btn-circle i {
            position: relative;
            top: -1px;
          } .btn-circle-lg {
            width: 100px;
            height: 100px;
            line-height: 55px;
            font-size: 1.1rem;
          }
            .btn-circle-xl {
            width: 120px;
            height: 120px;
            line-height: 20px;
            font-size: 1.1rem;
            } #user {
              top: 5px;
              right: 5px;
            }
        </style>
    </head>

    <body>



  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-logo">
      <img src='images/ouch.png' alt="Test" height="120" width="200"/>
      <?php
        echo ("<h3>" . 'Username: ' . $seshUser . "</h3>");
      ?>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="mainInter.php">Home</a></li>
      <li><a href='recordInjury.php'>Record another Injury</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
      <?php




      //Create table of injuries
      $rows = query("SELECT * FROM $DBInjuryTable WHERE txtUsername='$seshUser'");

      $table = '<table class="table">';
      $table .= '<tr><th>Type</th><th>Cause</th><th>Symptoms</th><th>Severity</th><th>Date</th><th>Notes</th></tr>';
      foreach ($rows as &$row) {

        $table .= '<tr>' .
                     '<td>' . $row['txtInjuryType'] . '</td>' .
                     '<td>' . $row['txtInjuryCause'] . '</td>' .
                     '<td>' . $row['txtInjurySymptoms'] . '</td>' .
                     '<td>' . $row['txtInjurySeverity'] . '</td>' .
                     '<td>' . $row['dateTime'] . '</td>' .
                     '<td>' . $row['txtNotes'] . '</td>' .
                 '</tr>';
      }
      $table .=  '</table>';

      echo $table;
      
      
      
          
          /*$A = array("Shoulder", "Wrist", "Shoulder", "Shoulder", "Conusssion");
          echo ($A[0]);*/
          /**
           *Quicksort function
           * @param {number} - A, the array
           * @param {number} - lo, the lowest number
           * @param {number} - hi, the highest number
           * @returns {array} - Sorted array
           */
      
            /*function quicksort($A, $lo, $hi) {
            if (!isset($lo)) {
                $lo = 0;
                }
            if (!isset($hi)) {
              $hi = strlen($A)-1;
            }
            if ($lo < $hi) {
              $p = partition($A, $lo, $hi);
              quicksort($A, $lo, $p - 1);
              quicksort($A, $p + 1, $hi);
            }
            return $A;
          }*/

          

          /**
           *Partition function
           * @param {number} - A, the array
           * @param {number} - lo, the lowest number
           * @param {number} - hi, the highest number
           * @returns {array} - Sorted array
           */
          /*function partition($A, $lo, $hi) {
            $pivot = A[hi];
            $i = $lo;
            for ($j = $lo; $j < $hi; $j++) {
              if ($A[$j] < $pivot) {
                //swap A[i] with A[j]
                $temp = $A[$i];
                  $A[$i] = $A[$j];
                  $A[$j] = $temp;
                $i = $i + 1;
              }
            }
            //swap A[i] with A[hi]
              $temp = $A[$i];
                  $A[$i] = $A[$hi];
                  $A[$hi] = $temp;
            return $i;
          }*/
      


      ?>


        <script>
          var A = ['Shoulder', 'Wrist', 'Shoulder', 'Shoulder', 'Conusssion'];
          /**
           *Quicksort function
           * @param {number} - A, the array length
           * @param {number} - lo, the lowest number
           * @param {number} - hi, the highest number
           * @returns {array} - Sorted array
           */
            function quicksort(A, lo, hi) {
            if (lo == undefined) {
                lo = 0;
                }
            if (hi == undefined) {
              hi = A.length-1;
            }
            if (lo < hi) {
              var p = partition(A, lo, hi);
              quicksort(A, lo, p - 1);
              quicksort(A, p + 1, hi);
            }
            return A;
          
          console.log(quicksort([5,7,3,9]));
          console.log(quicksort(['Shoulder', 'Wrist', 'Shoulder', 'Shoulder', 'Concussion', 'Arm']));
          

          /**
           *Partition function
           * @param {number} - A, the array length
           * @param {number} - lo, the lowest number
           * @param {number} - hi, the highest number
           * @returns {array} - Sorted array
           */
          function partition(A, lo, hi) {
            var pivot = A[hi];
            var i = lo;
            for (var j = lo; j < hi; j++) {
              if (A[j] < pivot) {
                //swap A[i] with A[j]
                var temp = A[i];
                  A[i] = A[j];
                  A[j] = temp;
                i = i + 1;
              }
            }
            //swap A[i] with A[hi]
              var temp = A[i];
                  A[i] = A[hi];
                  A[hi] = temp;
            return i;
          }
        </script>
    </body>
</html>
