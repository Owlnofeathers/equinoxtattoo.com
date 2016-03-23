<?php 
  include'includes/form.php';
  include'includes/header.php';

  $db = new Database();

  $artists = $db->select("SELECT * FROM tblArtists WHERE ArtistSwitch = 1");
?>

  <section class="section-title">
      <div class="container">
        <div class="animated fadeIn">
          <h1><i class="fa fa-diamond"></i> Book An Appointment</h1>
        </div>
      </div>
  </section>

	<section>
	  <div class="container">
		<div class="row">
		  <div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			  <li class="active">Booking Request</li>
			</ol>
		  </div>
		</div>
	</section>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p>Please give us some essential information about the tattoo you would like to get.  We will contact you back as soon as we can to schedule a consultation and/or book an appointment with you.  If the artist you are requesting is unavailable or the piece you want is not suitable for someone at our studio, will will try and help you find an artist who you can work with.  Thank you for your request!</p><br>
          <form class="form-horizontal" role="form" method="post" action="booking.php#form">
            <fieldset>
              <legend>Booking Request Form</legend>
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
                  <?php echo "<p class='text-danger'>$errName</p>";?>
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="(123) 456-7890">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                  <?php echo "<p class='text-danger'>$errEmail</p>";?>
                </div>
              </div>

              <div class="form-group">
                <label for="select" class="col-lg-2 control-label">Preferred Artist</label>
                <div class="col-lg-10">
                  <select class="form-control" id="select" name="artist">
                    <option>Any Artist</option>
                    <?php foreach ($artists as $artist) : ?>
                      <option><?php echo htmlspecialchars($artist['Name']); ?></option> 
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Previous client?</label>
                <div class="col-lg-10 btn-group" data-toggle="buttons">
                  <label class="btn btn-primary active">
                      <input type="radio" name="client" id="radio1" value="No" autocomplete="off" checked="checked">
                      No
                  </label>
                  <label class="btn btn-primary">
                      <input type="radio" name="client" id="radio2" value="Yes" autocomplete="off">
                      Yes
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Are you...</label>
                <div class="col-lg-10 btn-group" data-toggle="buttons">
                  <label class="btn btn-primary active">
                    <input type="radio" name="distance" id="radio3" value="local" checked="checked">
                    Local
                  </label>
                  <label class="btn btn-primary">
                    <input type="radio" name="distance" id="radio4" value="traveling">
                    Traveling
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="placement" class="col-sm-2 control-label">Tattoo Placement</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="placement" name="placement" placeholder="Area of body">
				          <?php echo "<p class='text-danger'>$errPlacement</p>";?>
                </div>
              </div>
              <div class="form-group">
                <label for="select" class="col-lg-2 control-label">Skin Tone</label>
                <div class="col-lg-10">
                  <select class="form-control" id="select" name="skin" placeholder="Select skin tone">
                    <option></option>
                    <option>Fair</option>
                    <option>Pink</option>
                    <option>Light/Medium</option>
                    <option>Tan</option>
                    <option>Dark</option>
                  </select>
				          <?php echo "<p class='text-danger'>$errSkin</p>";?>
                </div>
              </div>
              <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Tattoo Idea</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                  <span class="help-block">Briefly explain your tattoo idea.</span>
                  <?php echo "<p class='text-danger'>$errMessage</p>";?>
                </div>
              </div>
              <div class="form-group">
                <label for="location" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="location" name="location" placeholder="Enter convention or guest spot">
                  <span class="help-block">If you are seeking an appointment with an artist at a convention or guest spot, please specify here.</span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                  <input id="submit" name="submit" type="submit" value="Send" class="btn btn-success btn-lg">
                </div>
              </div>
              <div id="form" class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                  <?php echo $result; ?>  
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include'includes/footer.php';?>

  </body>
</html>
