<?php
  require 'auth.php';
  include 'includes/navigation.html';
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h3 class="page-header">Welcome to the Equinox Tattoo Collective Administration page.</h3>
        <p>Use the navigation bar to find the area you would like to edit.</p><br>
        <p>To view the website in a new tab: <br>
          <p><a href="http://equinoxtattoo.com/" class="btn btn-lg btn-success active" role="button" target="_blank">ETC Home</a></p>
        </p>
      </div>
    </div>
  </div>

  <?php readfile('includes/footer.html'); ?>