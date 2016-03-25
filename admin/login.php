<?php
  session_start();
  require 'includes/password.php';
  include '../config/config.php';
  include '../libraries/Database.php';
  include '../libraries/User.php';

  $db = new Database();
  $us = new User();

  if (isset($_POST['name']) && isset($_POST['password'])) {
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $usr = $db->select($us->getUserByName($name));
    $row = $usr->fetch_assoc();
    if ($row) {
        $hash = $row['Password'];
        $isAdmin = $row['isAdmin'];

        if (password_verify($_POST['password'], $hash)) {

            $_SESSION['user'] = $row['Name'];
            $_SESSION['isAdmin'] = $isAdmin;
            header('Location: index.php');

        } else {
            $message = '<div class="alert alert-danger" role="alert">Login failed.</div>';
        }
    } else {
        $message = '<div class="alert alert-danger" role="alert">Login failed.</div>';
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/tat-machine.ico">

    <title>Sign In | Equinox Admin</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <h1 class="page-header text-center">ETC Administration Page</h1>
      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="inputName" class="sr-only">Login Name</label>
        <input type="text" name="name" id="inputName" class="form-control" placeholder="Login Name" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

      <div class="col-sm-2 col-sm-offset-5 text-center">
        <?php
            echo "<p>$message</p>";
        ?>
      </div>

    </div> <!-- /container -->

  </body>
</html>