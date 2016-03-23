<?php
  ob_start();
  include '../config/config.php';
  include '../libraries/Database.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/tat-machine.ico">

    <title>Equinox Admin</title>
    <!-- BootStrap theme of parent site -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../admin/css/dropify.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles of parent site -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- Custom admin styles -->
    <link href="css/style.css" rel="stylesheet">
  </head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">ETC Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Users <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="userSelect.php"><i class="fa fa-users"></i> All Users</a></li>
            <li><a href="userInsert.php"><i class="fa fa-user-plus"></i> New User</a></li>
          </ul>
        </li>
        <li><a href="slideSelect.php"><i class="fa fa-picture-o"></i> Slider</a></li>
        <li><a href="gallerySelect.php"><i class="fa fa-star"></i> Gallery</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class=" fa fa-calendar-check-o"></i> Events <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="eventSelect.php"><i class="fa fa-calendar-check-o"></i> All Events</a></li>
            <li><a href="eventInsert.php"><i class="fa fa-calendar-plus-o"></i> New Event</a></li>
          </ul>
        </li>
        <li><a href="artistSelect.php"><i class="fa fa-paint-brush"></i> Artists</a></li>      
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://equinoxtattoo.com/store/TacocaT3/login.php" target="_blank"><i class="fa fa-lock"></i> Store Admin</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sign-out"></i> Log Out <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="navbar-text"><i class="fa fa-sign-in"></i> 
              : 
              <?php
                $user = $_SESSION['user']; 
                if($_SESSION['user']) {
                  echo $user;
                  } else { echo "Username not set";
                }
              ?>
            </li>
            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="row">
  <div class="col-sm-12">
    <?php if(isset($error)) : ?>
      <div class="alert alert-danger"><?php echo $error ;?></div>
    <?php endif; ?>
    <?php if(isset($_GET['msg'])) : ?>
      <div class="alert alert-success"><?php echo htmlentities($_GET['msg']) ;?></div>
    <?php endif; ?>
  </div>
</div>


