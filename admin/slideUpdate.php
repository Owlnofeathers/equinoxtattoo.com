<?php
  session_start();
  require 'auth.php';
  include 'includes/header.php';
  include 'includes/upload.php';

  $db = new Database();

  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: slideSelect.php');
  }

  $enabled = '';
  $heading = '';
  $text = '';
  $buttonSwitch = '';
  $buttonText = '';
  $buttonLink = '';

  if (isset($_POST['save'])) {
    $ok = true;
    $enabled = mysqli_real_escape_string($db->link, $_POST['enabled']);
    $buttonSwitch = mysqli_real_escape_string($db->link, $_POST['buttonSwitch']);
    $heading = mysqli_real_escape_string($db->link, $_POST['heading']);
    $text = mysqli_real_escape_string($db->link, $_POST['slideText']);
    $buttonText = mysqli_real_escape_string($db->link, $_POST['buttonText']);
    $buttonLink = mysqli_real_escape_string($db->link, $_POST['buttonLink']);
  }

    if ($ok) {
      $update_row = $db->update("UPDATE tblSliders SET SlideSwitch='$enabled', Heading='$heading', SlideText='$text', ButtonSwitch='$buttonSwitch', ButtonText='$buttonText', ButtonLink='$buttonLink'
          WHERE id=" .$id);
    } else {
      $sliders = $db->select("SELECT * FROM tblSliders WHERE id = " .$id);
 
      foreach ($sliders as $slider) {
          $enabled = $slider['SlideSwitch'];
          $heading = $slider['Heading'];
          $text = $slider['SlideText'];
          $buttonSwitch = $slider['ButtonSwitch'];
          $buttonText = $slider['ButtonText'];
          $buttonLink = $slider['ButtonLink'];        
        }
  }

?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          Edit Slider <?php echo $id ?>
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Edit Slider <?php echo $id ?>" 
        data-content="The button link must have the entire URL (http://) included, unless the page is in the directory of the site (contact.php).
        For the images, you should have a back up of the previous image before you replace it here. Once replaced, the original is gone.
        The background of the slide must be roughly 1400 x 500 pixels and looks best to be greyed-out or blurred-out. 
        Name the background image 'bg<?php echo $id ?>.jpg' before uploading it. The image in the foreground should be roughly 400 pixels square.
        It looks best to be 'trimmed out' and have a transparent background. The inner image must be named 'inner-image<?php echo $id ?>.png'.">
        <i class="fa fa-info-circle"></i></a></h2>
      </div>
      <div class="col-md-8">
        <form class="form-horizontal" method="post" action="">
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Enable Slider</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($enabled === '0') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="enabled" id="radio1" value="0" <?php
                    if ($enabled === '0') {
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
            <label for="heading" class="col-sm-3 control-label">Slide Heading</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="heading" value="<?php
                echo htmlspecialchars($heading);
                ?>" placeholder="Slide Heading">
            </div>
          </div>

          <div class="form-group">
            <label for="slideText" class="col-sm-3 control-label">Slider Text</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="4" name="slideText"><?php echo htmlspecialchars($text);?></textarea>
              <span class="help-block"><small>Too much text here will push the inner image out of the slide!</small></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Enable Button</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($buttonSwitch === '0') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="buttonSwitch" id="radio3" value="0" <?php
                    if ($buttonSwitch === '0') {
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
              <button type="submit" name="save" class="btn btn-default btn-lg">Submit</button>
            </div>
          </div>
        </form>
      </div>

      <div class="col col-md-4">  
          <?php
            echo "<p>$message</p>";        
          ?>
        <div class="panel panel-default">   
           <div class="panel-heading"><strong>
            Replace Background Image
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Images" 
          data-content="This slide background must be roughly 1400 x 500 pixels and looks best to be greyed-out or blurred-out.
          Make sure the image is renamed 'bg<?php echo $id ?>.jpg' before upload.">
          <i class="fa fa-info-circle"></i></a></strong></div>  
          <div class="panel-body upload">
            <form action="<?php uploadTo3('../images/'); ?>" method="post" enctype="multipart/form-data">
              <label for="fileToUpload3" class="control-label">Select file for the background of the slide</label><br>
              <small class="text-danger">Name your new image "bg<?php echo $id ?>.jpg" then upload it here to replace the current background.</small>
              <input type="file" name="fileToUpload3" id="fileToUpload3" class="dropify" data-default-file="../images/bg<?php echo $id ?>.jpg" />
              <button type="submit" class="btn btn-primary btn-lg" value="Upload Image" name="submit3">Replace File</button>
            </form>
          </div>
        </div>

        <div class="panel panel-default">   
          <div class="panel-heading"><strong>
            Replace Inner Image
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Images" 
          data-content="This image for the slide foreground should be roughly 400 pixels square. It looks best to be 'trimmed out' and have a transparent background. 
          The inner image must be named 'inner-image<?php echo $id ?>.png' before upload.">
          <i class="fa fa-info-circle"></i></a></strong></div>
          <div class="panel-body upload">
            <form action="<?php uploadTo3('../images/'); ?>" method="post" enctype="multipart/form-data">
              <label for="fileToUpload3" class="control-label">Select file for the image in the foreground</label><br>
              <small class="text-danger">Name your new image "inner-image<?php echo $id ?>.png" then upload it here to replace the current inner image.</small>
              <input type="file" name="fileToUpload3" id="fileToUpload3" class="dropify" data-default-file="../images/inner-image<?php echo $id ?>.png" />
              <button type="submit" class="btn btn-primary btn-lg" value="Upload Image" name="submit3">Replace File</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php readfile('includes/footer.html'); ?>