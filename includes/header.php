<?php 
	ob_start(); 
  include 'config/config.php';
	include 'libraries/Database.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- meta description and keyword tags for google -->
    <meta name="description" content="At Equinox Tattoo Collective and Gallery we feature quality custom tattooing services 
    in a range of styles as well as a gallery for local artists and collective members to showcase their work for the community.">
    <meta name="keywords" content="portland, gresham, oregon, artists, tattoo, equinox tattoo collective, equinox tattoo, shelly deangio, art, body-art">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="images/tat-machine.ico">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <title>Equinox Tattoo Collective</title>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-67706116-1', 'auto');
      ga('send', 'pageview');
    </script>

  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Equinox Tattoo Collective</a>
        </div>

        <?php
            // activate navbar
            function echoActive($requestUri)
            {
                $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

                if ($current_file_name == $requestUri)
                    echo 'active';
            }
        ?>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?=echoActive("index")?>"><a href="index.php">Home</a></li>
            <li class="<?=echoActive("about")?>"><a href="about.php">About</a></li>
            <li class="<?=echoActive("artists")?>"><a href="artists.php">Artists</a></li>
            <li class="<?=echoActive("booking")?>"><a href="booking.php">Booking Request</a></li>
            <li class="<?=echoActive("about")?>"><a href="about.php#faqlink">FAQ</a></li>
            <li class="<?=echoActive("contact")?>"><a href="contact.php">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>