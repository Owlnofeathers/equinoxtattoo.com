<?php 
	require'includes/gallery.php';
	include'includes/header.php';

	$db = new Database();
?>

<section class="top">
	<div class="jumbotron">
	  <div class="container animated fadeIn">
	  	<div class="wow fadeInLeft" data-wow-duration="3s">
	  		<img class="img-responsive pull-right" src="images/equinox-logo.png" alt="Logo image">
	  	</div>
		<h1>Equinox Tattoo Collective</h1>
		<p>Looking to book your next tattoo appointment with one of our artists?  Just click below to find instructions and submit your request and we will contact you to set up a consultation.</p>
		<p><a class="btn btn-success btn-lg" href="booking.php" role="button">Book An Appointment</a></p>
	  </div>
	</div>
</section>

<!-- Slider Section -->
<?php

    $sliders= $db->select("SELECT * FROM tblSliders WHERE SlideSwitch = 1");
	$count  =   mysqli_num_rows($sliders);
	$slides='';
	$Indicators='';
	$counter=0;
	 
	    while($row = $sliders->fetch_assoc())
	    {
	 
	        $title = $row['Heading'];
	        $desc = $row['SlideText'];
	        $id = $row['id'];	     
	        $buttonLink = $row['ButtonLink'];
	        $buttonText = $row['ButtonText'];

	        if($row['ButtonSwitch'] == 1) {
	        	$button = '<p class="text-center"><a class="btn btn-success" href="'.$buttonLink.'">'.$buttonText.'</a></p>';
	        } else {
	        	$button = '';
	        }

	        if($counter == 0)
	        {
	            $Indicators .='<li data-target="#myCarousel" data-slide-to="'.$counter.'" class="active"></li>';
	            $slides .= '
	            <div class="item active">
		            <img src="images/bg'.$id.'.jpg" alt="'.$title.'" />
		            <div class="container">
			            <div class="carousel-caption">
				            <div class="row">
				        		<div class="col-md-7 col-sm-7">
						            <h2>'.$title.'</h2>
						            <p>'.$desc.'</p>
						            '.$button.'
								</div> 
								<div class="col-lg-3 col-md-5 col-sm-5 col-xs-8">
					        		<img class="inner-image" src="images/inner-image'.$id.'.png"> 
					        	</div>       
				            </div>
			            </div>
		            </div>
	            </div>
	        	';
	 
	        }
	        else
	        {
	            $Indicators .='<li data-target="#myCarousel" data-slide-to="'.$counter.'" class="active"></li>';
	            $slides .= '
	            <div class="item">
		            <img src="images/bg'.$id.'.jpg" alt="'.$title.'" />
		            <div class="container">
			            <div class="carousel-caption">
				            <div class="row">
				        		<div class="col-md-7 col-sm-7">
						            <h2>'.$title.'</h2>
						            <p>'.$desc.'</p>
						            '.$button.' 
								</div> 
								<div class="col-lg-3 col-md-5 col-sm-5 col-xs-8">
					        		<img class="inner-image" src="images/inner-image'.$id.'.png"> 
					        	</div>       
				            </div>
			            </div>
		            </div>
	            </div>
	        	';
	        }
	        
	        $counter++;
	    }
	 
	?>

	<section>
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<?php echo $Indicators; ?>	
		  </ol>

		  <!-- Wrapper for slides -->
		 <div class="carousel-inner" role="listbox">
			<?php echo $slides; ?>
		  </div> <!-- end sliders -->

		  <!-- Controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</section>

	<!-- Gallery Section -->
	<?php
        $galleries = $db->select("SELECT * FROM tblGallery WHERE GallerySwitch = 1");

        foreach ($galleries as $gallery) {
        	printf('
        		<section>
        			<div class="container art-gallery">
        				<h2 class="page-header">Currently Showing in the ETC Art Gallery</h2>
        				<p>%s<a href="%s" data-toggle="tooltip" data-placement="top" title="%s`s contact"> %s</a>.</p>
        				<div class="row">
        					<div class="grid js-masonry col-md-12">
        		',
              htmlspecialchars($gallery['GalleryText']),
              htmlspecialchars($gallery['GalleryLink']),
              htmlspecialchars($gallery['GalleryName']),
              htmlspecialchars($gallery['GalleryName'])
              );

        	gallery_display('images/gallery/', 'art gallery', 'Artist'); 

        	print('
        					</div>
        				</div>
        			</div>
        		</section>
      			'
              );
        }
    ?>

    <!-- Events Section -->
	<section>
		<div class="container">
			<h2 class="page-header">Upcoming Events</h2>
			<div class="row event-list">
				<div class="col-md-12">
					<?php				        
				        $events = $db->select("SELECT * FROM tblEvents WHERE EventSwitch = 1");

				        foreach ($events as $event) {
				            printf('				              
				            	<div class="panel panel-default">
				              		<div class="panel-body">
				                		<h3>%s</h3>
				                		<p>%s</p>
				                ',
				              htmlspecialchars($event['Heading']),
				              htmlspecialchars_decode($event['EventText'])
				              );
				              		     
				            if($event['ButtonSwitch'] == 1){
				            	printf('
				            				<p><a class="btn btn-success" href="%s">%s</a></p>
				            			</div>
				            		</div>
				            		',
				            	  htmlspecialchars($event['ButtonLink']),
				                  htmlspecialchars($event['ButtonText'])	
				              	  );

					        } else {
					        	print('
					            		</div>
					            	</div>
					            	');
				        	}
				    	}												 
				    ?>
				</div>
			</div>
		</section>

		<section>
			<div class="row text-center">
				<div class="col-md-4 col-sm-4 col-xs-6 wow slideInLeft">
					<i class="fa fa-cogs fa-5x fa-border"></i>
					<h2>Who Are We?</h2>
					<p>Learn more about <strong>ETC</strong>!</p>
					<p><a class="btn btn-success" href="about.php">About Us</a></p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6 wow slideInRight">
					<i class="fa fa-paint-brush fa-5x fa-border"></i>
					<h2>Artists</h2>
					<p>Find an artist with a style that inspires you.</p>
					<p><a class="btn btn-success" href="artists.php">View Portfolios</a></p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 wow">
					<i class="fa fa-calendar-check-o fa-5x fa-border"></i>
					<h2>Get Tattooed</h2>
					<p>You can submit your request online!</p>
					<p><a class="btn btn-success" href="booking.php">Book An Appointment</a></p>
				</div>
			</div>
		</div>
	</section>

	<?php include'includes/footer.php';?>

	<script src="js/masonry.js"></script>
	<!-- needed so images wouldnt stack on top of each other on load -->
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
