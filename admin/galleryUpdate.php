<?php
session_start();
require 'auth.php';
include 'includes/navigation.html';
include 'includes/upload.php';


  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: gallerySelect.php');
  }

  $enabled = '';
  $galleryName = '';
  $galleryLink = '';
  $galleryText = '';

  if (isset($_POST['save'])) {
    $ok = true;
    if (!isset($_POST['gallerySwitch']) || $_POST['gallerySwitch'] === '') {
        $ok = false;
    } else {
        $enabled = $_POST['gallerySwitch'];
    }
    if (!isset($_POST['galleryName']) || $_POST['galleryName'] === '') {
        $ok = false;
    } else {
        $galleryName = $_POST['galleryName'];
    }
    if (!isset($_POST['galleryLink']) || $_POST['galleryLink'] === '') {
        $ok = false;
    } else {
        $galleryLink = $_POST['galleryLink'];
    }
    if (!isset($_POST['galleryText']) || $_POST['galleryText'] === '') {
        $ok = false;
    } else {
        $galleryText = $_POST['galleryText'];
    }

    if ($ok) {
        // add database code here
        include '../includes/databaseConnection.php';
        $sql = sprintf("UPDATE tblGallery SET GallerySwitch='%s', GalleryName='%s', GalleryLink='%s', GalleryText='%s'
          WHERE id=%s",
          mysqli_real_escape_string($db, $enabled),
          mysqli_real_escape_string($db, $galleryName),
          mysqli_real_escape_string($db, $galleryLink),
          mysqli_real_escape_string($db, $galleryText),
          $id);
        mysqli_query($db, $sql);
        $message = '<div class="alert alert-success" role="alert">Gallery updated.</div>';
        mysqli_close($db);
      }
  } else {
      include '../includes/databaseConnection.php';
      $sql = sprintf('SELECT * FROM tblGallery WHERE id=%s', $id);
      $result = mysqli_query($db, $sql);
      foreach ($result as $row) {
          $enabled = $row['GallerySwitch'];
          $galleryName = $row['GalleryName'];
          $galleryLink = $row['GalleryLink'];
          $galleryText = $row['GalleryText'];       
        }
      mysqli_close($db);
  }

?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          Edit Gallery
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Edit Gallery" 
        data-content="Enter whatever the artist would like to be referenced as in the 'Name' field.
        Enter the full URL of the location the artist would like to share. The 'Description' area must be phrased in a way that
        leads up to the artist's name. Immediately following the description, the arists name with a hyperlink to 'Contact URL'
        will be displayed automatically (Check out these paintings by). MAKE SURE YOUR ORIGINAL IMAGES ARE BACKED UP!
        Once you select 'Delete', it's gone. ALL images uploaded in this page will be displayed on the site. Choose a number of
        images that is appropriate for the size you would like the gallery to be on your home page.">
        <i class="fa fa-info-circle"></i></a></h2>
      </div>
      <div class="col-md-8">
        <form class="form-horizontal" method="post" action="">

          <div class="form-group">
            <label class="col-sm-3 control-label">Enable Gallery</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($enabled === '0') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="gallerySwitch" id="radio1" value="0" <?php
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
                  <input type="radio" name="gallerySwitch" id="radio2" value="1" <?php
                    if ($enabled === '1') {
                        echo ' checked';
                    }
                ?>> Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="galleryName" class="col-sm-3 control-label">Artist's Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="galleryName" value="<?php
                echo htmlspecialchars($galleryName);
                ?>" placeholder="Artist's Name">
            </div>
          </div>

          <div class="form-group">
            <label for="galleryLink" class="col-sm-3 control-label">Artist's Contact URL</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="galleryLink" value="<?php
                echo htmlspecialchars($galleryLink);
                ?>" placeholder="Artist's Contact URL">
            </div>
          </div>

          <div class="form-group">
            <label for="galleryText" class="col-sm-3 control-label">Gallery Description</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="4" name="galleryText"><?php echo htmlspecialchars($galleryText);?></textarea>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">
              How the description will appear on the site
            </div>
            <div class="panel-body">
              <?php echo htmlspecialchars($galleryText);?> <a href="<?php echo htmlspecialchars($galleryLink); ?>" title="<?php echo htmlspecialchars($galleryName);?>'s contact"><?php echo htmlspecialchars($galleryName);?>.</a>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
              <button type="submit" name="save" class="btn btn-default btn-lg">Submit</button>
            </div>
          </div>
        </form>
       <!--  <div class="col-sm-offset-2 col-sm-6 text-center">
          <?php
            //  echo "<p>$message</p>";
          ?>
        </div> -->
      </div>
      <div class="col col-md-4">  
          <?php
            echo "<p>$message</p>"; 

            // debug
            //print_r($_FILES);        
          ?>
        <div class="panel panel-default">   
         <div class="panel-heading"><strong>
          Upload Images To Gallery
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Images" 
          data-content="The image needs to be a .jpg, .png, .gif, or .jpeg format.">
          <i class="fa fa-info-circle"></i></a></strong></div>  
          <div class="panel-body upload">
            <form action="<?php uploadTo('../images/gallery/'); ?>" method="post" enctype="multipart/form-data">
              <label for="fileToUpload" class="control-label">Select File</label>
              <input type="file" name="fileToUpload" id="fileToUpload" class="dropify" data-default-file="" />
              <button type="submit" class="btn btn-primary btn-lg" name="submit">Upload File</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col col-md-4">           
        <table class="table table-responsive">  
          <?php
          if (array_key_exists('delete_file', $_POST)) {
          $filename = $_POST['delete_file'];
          if (file_exists($filename)) {
            unlink($filename);
            $message = '<div class="alert alert-success" role="alert">File '.$filename.' deleted.</div>';
          } else {
            $message = '<div class="alert alert-danger" role="alert">Could not delete file '.$filename.'. File does not exist.</div>';
          }
        }
          $files = glob("../images/gallery/*");
          foreach ($files as $file) {
              echo "<tr><td>"; 
              echo '<img class="img-thumbnail img-responsive" src="'.$file.'" width="70%"/></td>';
              echo '<td><form method="post">';
              echo '<input type="hidden" value="'.$file.'" name="delete_file" />';
              echo '<input type="submit" class="btn btn-danger delete" value="Delete Image" />';
              echo '</form></td></tr>';
         
          }
          ?>
        </table>  
      </div>
    </div>
  </div>

<?php readfile('includes/footer.html'); ?>