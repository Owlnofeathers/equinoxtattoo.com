<?php 
  require'includes/gallery.php';
  require'includes/header.php';

  $db = new Database();
  $ar = new Artist();

  if (isset($_GET['id'])){
	 $id = $_GET['id'];
  } else {
    header("Location: artists.php");
    exit();
  }

  $artist = $db->select($ar->getArtistById($id));

  foreach ($artist as $row) {
  	$id = $row['id'];
      $name = $row['Name'];
      $price = $row['Price'];
      $description = $row['Description'];
      $facebook = $row['Facebook'];
      $instagram = $row['Instagram'];
      $email = $row['Email'];
  }
?>

<section class="section-title">
  <div class="container">
      <div class="animated fadeIn">
      	<h1><i class="fa fa-diamond"></i> <?php echo $name; ?></h1>
      </div>
  </div>
</section>

<section>
  <div class="container">
	<div class="row">
	  <div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="artists.php">Artists</a></li>
		  <li class="active"><?php echo $name; ?></li>
		</ol>
	  </div>
	</div>

	<div class="artists row wow fadeInUp">
  		<div class="col-md-12">
  			<div class="artist" align="middle">
      			<img src="images/artist<?php echo $id; ?>.jpg" class="img-responsive img-thumbnail img-circle" alt="Image of <?php echo $name; ?>">
      		</div>
      		<h3><?php echo $name; ?></h3>
      		<p><i class="fa fa-dollar"></i><?php echo $price; ?> /hr</p>
      		<p><?php echo $description; ?></p>
      		<ul class="list-unstyled list-inline list-social-icons">
        		<li class="tooltip-social facebook-link"><a href="<?php echo $facebook; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $name; ?>`s Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
        		<li class="tooltip-social instagram-link"><a href="<?php echo $instagram; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $name; ?>`s Instagram"><i class="fa fa-instagram fa-2x"></i></a></li>
        		<li class="tooltip-social email-link"><a href="<?php echo $email; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $name; ?>`s Contact"><i class="fa fa-envelope fa-2x"></i></a></li>
      		</ul>
		</div>
		<div class="grid js-masonry col-md-12 wow fadeIn" data-wow-delay="1.5s">

		<?php			
	    gallery_display("images/artist$id/displayed/", "artist gallery $id", $name);
	    gallery_display("images/artist$id/", "artist gallery $id", $name);
    ?>

    </div>
  </div>

</section>

<?php include'includes/footer.php';?>

<script src="js/masonry.js"></script>
<!-- needed so images wouldn't stay stacked on top of each other on load -->
<script src="js/imagesLoaded.js"></script>
<script>
var $container = $('.grid');
$container.imagesLoaded(function(){
  $container.masonry({
	itemSelector : '.grid-item'
  });
});
</script>

  </body>
</html>
