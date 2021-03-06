<?php
session_start();
require 'common.php';
?>

<!DOCTYPE html>


<html lang="en">
    <head>
      <title>Ouch!</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1" shrink-to-fit=no>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <style type="text/css" >
     #pword {
         font-size: 12px;
    }
     form {
         display: inline-block;
    }
     body {
         text-align: center;
    }
     input[type=text], input[type=password], input[type=email] {
         padding: 15px;
         margin: 5px 0 22px 0;
         display: inline-block;
         border: none;
         background: #f1f1f1;
    }
     input[type=text]:focus, input[type=password]:focus {
         background-color: #ddd;
         outline: none;
    }
     hr {
         border: 1px solid #f1f1f1;
         margin-bottom: 25px;
    }
     button:hover {
         opacity:1;
    }
     #signup {
         padding: 14px 20px;
         background-color: lightcoral;
    }
     #form {
         position: sticky;
    }

      </style>
    </head>

    <body>
      <div class="navbar-logo">
          <img src='images/ouch.png' alt="Test" height="100" width="140" />
      </div>

      <h1>Create account</h1>

      <!--Sign Up form-->
      <form id='form' action="signUp.php" method='post'>
        <label for='first'>First Name:</label>
        <input type='text' name='first' id='first' placeholder="First Name">
        <label for='last'>Surname:</label>
        <input type='text' name='last' id='last' placeholder="Surname"><br>
        <label for='user'>Username:</label>
        <input type='text' name='username' id='user' placeholder="Username">
        <label for='email'>Email:</label>
        <input type='email' name='email' id='email' placeholder="Email"><br>
        <label for='dob'>Date of Birth (Optional):</label>
        <input type='date' name='dob' id='dob'><br>
        <label for='password'>Password:</label>
        <input type='password' name='password' id='password' placeholder="Password">
        <label for='confirm'>Confirm Password:</label>
        <input type='password' name='confirm' id='confirm' placeholder="Confirm Password">
        <p id='pword'>Password needs to contain 8 letters AND atleast:<br>One number, one lowercase letter, one uppercase letter</p>
        <input name='action' type='submit' value='Sign Up' id='signup'>

      </form>
<div></div>


      <?php


      /**
       *Sign Up function, allows users to create personalised account and sends user info to database
       */
      function doSignUp() {

        global $DBUserTable;

        //Set variables
        $first = $_POST['first'];
        $last = $_POST['last'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];

        $error = 0;


        if (empty($first) || empty($last) || empty($username) || empty($password) || empty($confirm) || empty($email)) {
              echo "You did not fill out the required fields.<br>";
              $error = 1;
          }

        //Password paramters
        if ($error == 0) {
        if (strlen($password) < 8) {
          echo ("- Password needs to contain atleast 8 characters<br>");
          $error = 1;
        } if( !preg_match("#[0-9]+#", $password ) ) {
          echo ("- Password must include at least one number!<br>");
          $error = 1;
          } if( !preg_match("#[a-z]+#", $password ) ) {
          echo ('- Password must include at least one lowercase letter!<br>');
          $error = 1;
          } if( !preg_match("#[A-Z]+#", $password ) ) {
          echo ('- Password must include at least one CAPS!<br>');
          $error = 1;
          } if ($password != $confirm) {
            echo ('- Passwords did not match<br>');
          $error = 1;
        }

        }
          //Username cant contain @
           if( preg_match("#[@]+#", $username ) ) {
          echo ("- Username can't contain '@'<br>");
          $error = 1;
          }


        //Email and username already exists check
        if ($error == 0) {
        $emails = query("SELECT * FROM $DBUserTable WHERE txtEmail='$email'");
        $usernames = query("SELECT * FROM $DBUserTable WHERE txtUsername='$username'");
        if ($emails) {
          echo ('Email already exists, ');
          $error = 1;
        }
        else if ($usernames) {
          echo ('Username already exists, ');
          $error = 1;
        }
        }

        //Check if valid email
        if ($error == 0) {
          if( !preg_match("#['@']+#", $email ) ) {
          echo ('- Invalid Email!<br>');
          $error = 1;
          }
        }

        if ($error == 0) {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);



        //Send user information to database
          if ($error == 0) {

            query("INSERT INTO $DBUserTable (txtGivenName, txtFamilyName, txtUsername, txtEmail, dateDOB, hash)
          VALUES ('$first', '$last', '$username', '$email', '$dob', '$hashed_password')");
          }
          else die();
      }
        if ($error == 0) {
        $_SESSION["username"] = $username;
      } else die();
      }

      /**
       *Directs user to main interface
       */
      function showMainPage() {
        header("Location: mainInter.php");
      }

       if (isset($_POST['action'])) {
        $action = $_POST['action'];

     //Switch statement
     switch ($action) {
        case 'Sign Up':
            doSignUp();
            showMainPage();
            break;
      }
       }
            ?>


        <script>

        </script>


    </body>
</html>
