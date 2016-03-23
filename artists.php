<?php 
	require'includes/gallery.php';
	require'includes/header.php';

	$db = new Database();

	$artists = $db->select("SELECT * FROM tblArtists WHERE ArtistSwitch = 1");
?>

<section class="section-title">
  <div class="container">
      <div class="animated fadeIn">
      	<h1><i class="fa fa-diamond"></i> Artists</h1>
      </div>
  </div>
</section>

<section>
  <div class="container">
	<div class="row">
	  <div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Artists</li>
		</ol>
	  </div>
	</div>

	<?php foreach ($artists as $artist) : ?> 
	    <?php 
	    	$id = $artist['id'];
	        $name = $artist['Name'];
	        $price = $artist['Price'];
	        $description = $artist['Description'];
	        $facebook = $artist['Facebook'];
	        $instagram = $artist['Instagram'];
	        $email = $artist['Email'];
	        $artist_link = urlencode($artist['id']);
	    ?>

		<div class="artists row wow fadeIn">
			<div class="col-lg-4 col-md-4 col-sm-4">
	    		<a href="artist.php?id=<?php echo $artist_link; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $name; ?>`s gallery page"><img src="images/artist<?php echo $id; ?>.jpg" class="img-responsive img-thumbnail img-circle" alt="Image of <?php echo $name; ?>">
	    		<h3><?php echo $name; ?></h3></a>
	    		<p><i class="fa fa-dollar"></i><?php echo $price; ?> /hr</p>
	    		<p><?php echo $description; ?></p>
	    		<ul class="list-unstyled list-inline list-social-icons">
	        		<li class="tooltip-social facebook-link"><a href="<?php echo $facebook; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $name; ?>`s Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
	        		<li class="tooltip-social instagram-link"><a href="<?php echo $instagram; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $name; ?>`s Instagram"><i class="fa fa-instagram fa-2x"></i></a></li>
	        		<li class="tooltip-social email-link"><a href="<?php echo $email; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $name; ?>`s Contact"><i class="fa fa-envelope fa-2x"></i></a></li>
	    		</ul>
			</div>
			<div class="grid js-masonry col-lg-7 col-md-6 col-sm-8">		
			<?php
			    gallery_display("images/artist$id/displayed/", "artist gallery $id", $name);
			    gallery_no_display("images/artist$id/", "artist gallery $id", $name);
			?>
		    </div>
	    </div>
    <?php endforeach; ?>
    
</section>

	<?php include 'includes/footer.php'; ?>

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