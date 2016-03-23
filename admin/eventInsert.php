<?php
session_start();
require 'auth.php';
include 'includes/header.php';

  $enabled = '';
  $heading = '';
  $text = '';
  $buttonSwitch = '';
  $buttonText = 'Edit This Button';
  $buttonLink = 'contact.php';

  if (isset($_POST['submit'])) {
    $ok = true;
    if (!isset($_POST['enabled']) || $_POST['enabled'] === '') {
        $ok = false;
    } else {
        $enabled = $_POST['enabled'];
    }
    if (!isset($_POST['heading']) || $_POST['heading'] === '') {
        $ok = false;
    } else {
        $heading = $_POST['heading'];
    }
    if (!isset($_POST['eventText']) || $_POST['eventText'] === '') {
        $ok = false;
    } else {
        $text = $_POST['eventText'];
    }
    if (!isset($_POST['buttonSwitch']) || $_POST['buttonSwitch'] === '') {
        $ok = false;
    } else {
        $buttonSwitch = $_POST['buttonSwitch'];
    }
    if (!isset($_POST['buttonText']) || $_POST['buttonText'] === '') {
        $ok = false;
    } else {
        $buttonText = $_POST['buttonText'];
    }
    if (!isset($_POST['buttonLink']) || $_POST['buttonLink'] === '') {
        $ok = false;
    } else {
        $buttonLink = $_POST['buttonLink'];
    }

     if ($ok) {
    
        include '../includes/databaseConnection.php';
        $sql = sprintf("INSERT INTO tblEvents (EventSwitch, Heading, EventText, ButtonSwitch, ButtonText, ButtonLink) VALUES (
          '%s', '%s', '%s', '%s', '%s', '%s'
        )", mysqli_real_escape_string($db, $enabled),
	        mysqli_real_escape_string($db, $heading),
	        mysqli_real_escape_string($db, $text),
	        mysqli_real_escape_string($db, $buttonSwitch),
	        mysqli_real_escape_string($db, $buttonText),
	        mysqli_real_escape_string($db, $buttonLink));

        mysqli_query($db, $sql);
        mysqli_close($db);   
        $message = '<div class="alert alert-success" role="alert">Event added.</div>';        
            
    } else {
    	$message = '<div class="alert alert-danger" role="alert">There was an error adding your event. Please enter something for all fields.</div>';
    }
    
  }


?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          New Event
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="New Event" 
        data-content="Enter a new event. Use as much text as you'd like. All hyperlinks must be used with the button. 
        If you choose NO for 'Enable Event', the event will be saved, but not displayed on the site.
        Button links must include the entire URL (http://) unless it is pointing to a page in this site (contact.php).">
        <i class="fa fa-info-circle"></i></a></h2>
        <form class="form-horizontal" method="post" action="">
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Enable Event</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($enabled === '') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="enabled" id="radio1" value="0" <?php
                    if ($enabled === '') {
                        echo ' checked';
                    }
                ?>>No
              </label>
              <label class="btn btn-primary <?php
                    if ($enabled === '1') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="enabled" id="radio2" value="1" <?php
                    if ($enabled === '1') {
                        echo ' checked';
                    }
                ?>> Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="heading" class="col-sm-3 control-label">Event Heading</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="heading" value="<?php
                echo htmlspecialchars($heading);
                ?>" placeholder="Event Heading">
            </div>
          </div>

          <div class="form-group">
            <label for="eventText" class="col-sm-3 control-label">Event Text</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="6" name="eventText"><?php echo htmlspecialchars($text);?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Enable Button</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($buttonSwitch === '') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="buttonSwitch" id="radio3" value="0" <?php
                    if ($buttonSwitch === '') {
                        echo ' checked';
                    }
                ?>>No
              </label>
              <label class="btn btn-primary <?php
                    if ($buttonSwitch === '1') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="buttonSwitch" id="radio4" value="1" <?php
                    if ($buttonSwitch === '1') {
                        echo ' checked';
                    }
                ?>> Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="heading" class="col-sm-3 control-label">Button Text</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="buttonText" value="<?php
                echo htmlspecialchars($buttonText);
                ?>" placeholder="Button Text">
            </div>
          </div>

          <div class="form-group">
            <label for="heading" class="col-sm-3 control-label">Button Link</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="buttonLink" value="<?php
                echo htmlspecialchars($buttonLink);
                ?>" placeholder="Button Link">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
              <button type="submit" name="submit" class="btn btn-default btn-lg">Submit</button>
            </div>
          </div>
        </form>
        <div class="col-sm-offset-2 col-sm-6 text-center">
          <?php
              echo "<p>$message</p>";
          ?>
        </div>
      </div>
    </div>
  </div>

<?php readfile('includes/footer.html'); ?>