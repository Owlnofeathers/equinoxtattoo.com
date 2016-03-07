<?php 
require'includes/gallery.php';
require'includes/header.php';
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

	<?php
        include 'includes/databaseConnection.php';

        $sql = 'SELECT * FROM tblArtists WHERE ArtistSwitch = 1';
        $result = mysqli_query($db, $sql);

        foreach ($result as $row) {
        	$id = $row['id'];
	        $name = $row['Name'];
	        $price = $row['Price'];
	        $description = $row['Description'];
	        $facebook = $row['Facebook'];
	        $instagram = $row['Instagram'];
	        $email = $row['Email'];
	        $artist_link = urlencode($row['id']);

        	echo('
        		<div class="artists row wow fadeIn">
	        		<div class="col-lg-4 col-md-4 col-sm-4">
		        		<a href="artist.php?id='.$artist_link.'" data-toggle="tooltip" data-placement="top" title="'.$name.'`s gallery page"><img src="images/artist'.$id.'.jpg" class="img-responsive img-thumbnail img-circle" alt="Image of '.$name.'">
		        		<h3>'.$name.'</h3></a>
		        		<p><i class="fa fa-dollar"></i>'.$price.' /hr</p>
		        		<p>'.$description.'</p>
		        		<ul class="list-unstyled list-inline list-social-icons">
			        		<li class="tooltip-social facebook-link"><a href="'.$facebook.'" data-toggle="tooltip" data-placement="top" title="'.$name.'`s Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
			        		<li class="tooltip-social instagram-link"><a href="'.$instagram.'" data-toggle="tooltip" data-placement="top" title="'.$name.'`s Instagram"><i class="fa fa-instagram fa-2x"></i></a></li>
			        		<li class="tooltip-social email-link"><a href="'.$email.'" data-toggle="tooltip" data-placement="top" title="'.$name.'`s Contact"><i class="fa fa-envelope fa-2x"></i></a></li>
		        		</ul>
					</div>
					<div class="grid js-masonry col-lg-7 col-md-6 col-sm-8">
				');
					
					    gallery_display("images/artist$id/displayed/", "artist gallery $id", $name);
					    gallery_no_display("images/artist$id/", "artist gallery $id", $name);

			echo('
				    </div>
			    </div>
        		');
        }
    ?>
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
