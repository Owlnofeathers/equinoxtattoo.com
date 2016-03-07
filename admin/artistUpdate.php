<?php
session_start();
require 'auth.php';
include 'includes/navigation.html';
include 'includes/upload.php';


  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: artistSelect.php');
  }

  $enabled = '';
  $name = '';
  $price = '';
  $description = '';
  $facebook = '';
  $instagram = '';
  $email = '';


  if (isset($_POST['save'])) {
    $ok = true;
    if (!isset($_POST['artistSwitch']) || $_POST['artistSwitch'] === '') {
        $ok = false;
    } else {
        $enabled = $_POST['artistSwitch'];
    }
    if (!isset($_POST['name']) || $_POST['name'] === '') {
        $ok = false;
    } else {
        $name = $_POST['name'];
    }
    if (!isset($_POST['price']) || $_POST['price'] === '') {
        $ok = false;
    } else {
        $price = $_POST['price'];
    }
    if (!isset($_POST['description']) || $_POST['description'] === '') {
        $ok = false;
    } else {
        $description = $_POST['description'];
    }
    if (!isset($_POST['facebook']) || $_POST['facebook'] === '') {
        $ok = false;
    } else {
        $facebook = $_POST['facebook'];
    }
    if (!isset($_POST['instagram']) || $_POST['instagram'] === '') {
        $ok = false;
    } else {
        $instagram = $_POST['instagram'];
    }
    if (!isset($_POST['email']) || $_POST['email'] === '') {
        $ok = false;
    } else {
        $email = $_POST['email'];
    }

    if ($ok) {
        // add database code here
        include 'includes/databaseConnection.php';
        $sql = sprintf("UPDATE tblArtists SET ArtistSwitch='%s', Name='%s', Price='%s', Description='%s', Facebook='%s', Instagram='%s', Email='%s'
          WHERE id=%s",
          mysqli_real_escape_string($db, $enabled),
          mysqli_real_escape_string($db, $name),
          mysqli_real_escape_string($db, $price),
          mysqli_real_escape_string($db, $description),
          mysqli_real_escape_string($db, $facebook),
          mysqli_real_escape_string($db, $instagram),
          mysqli_real_escape_string($db, $email),
          $id);
        mysqli_query($db, $sql);
        $message = '<div class="alert alert-success" role="alert">Artist updated.</div>';
        mysqli_close($db);
      }
  } else {
      include 'includes/databaseConnection.php';
      $sql = sprintf('SELECT * FROM tblArtists WHERE id=%s', $id);
      $result = mysqli_query($db, $sql);
      foreach ($result as $row) {
          $enabled = $row['ArtistSwitch'];
          $name = $row['Name'];
          $price = $row['Price'];
          $description = $row['Description']; 
          $facebook = $row['Facebook'];
          $instagram = $row['Instagram'];
          $email = $row['Email'];      
        }
      mysqli_close($db);
  }

?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          Edit Artist <?php echo $id ?>
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Edit Gallery" 
        data-content="If an artist is not enabled, the information will be saved, but just not displayed on the site.
        Enter whatever the artist would like to be referenced as in the 'Name' field.
        Enter the full URL of the location the artist would like to share (http://). MAKE SURE YOUR ORIGINAL IMAGES ARE BACKED UP!
        Once you select 'Delete', it's gone. All 'displayed' images will show in a gallery next to the artist's picture.
        Choose a number of images that is appropriate for the size you would like the gallery to be on your home page.">
        <i class="fa fa-info-circle"></i></a></h2>
      </div>
      <div class="col-md-8">
        <form class="form-horizontal" method="post" action="">

          <div class="form-group">
            <label class="col-sm-3 control-label">Enable Artist</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($enabled === '0') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="artistSwitch" id="radio1" value="0" <?php
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
                  <input type="radio" name="artistSwitch" id="radio2" value="1" <?php
                    if ($enabled === '1') {
                        echo ' checked';
                    }
                ?>> Yes
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Artist's Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="name" value="<?php
                echo htmlspecialchars($name);
                ?>" placeholder="Artist's Name">
            </div>
          </div>

          <div class="form-group">
            <label for="price" class="col-sm-3 control-label">Artist's Price</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="price" value="<?php
                echo htmlspecialchars($price);
                ?>" placeholder="Artist's Price">
            </div>
          </div>

          <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Artist's Description</label>
            <div class="col-sm-6">
              <textarea class="form-control editable" rows="4" name="description"><?php echo htmlspecialchars($description);?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="facebook" class="col-sm-3 control-label">Artist's Facebook URL</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="facebook" value="<?php
                echo htmlspecialchars($facebook);
                ?>" placeholder="Facebook URL">
            </div>
          </div>

          <div class="form-group">
            <label for="instagram" class="col-sm-3 control-label">Artist's Instagram URL</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="instagram" value="<?php
                echo htmlspecialchars($instagram);
                ?>" placeholder="Instagram URL">
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">
              Artist's Email or Other Link
            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Link" 
            data-content="If this is just a link to another site, enter the URL. If this is to an email address, include
            mailto: before the address so the computer or device will automatically open the email application. (mailto:tattoo.artist@domain.com)">
            <i class="fa fa-info-circle"></i></a></label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="email" value="<?php
                echo htmlspecialchars($email);
                ?>" placeholder="Artist's Link">
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
            Upload Artist's Image
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Images" 
          data-content="This image will be displayed on the site centered in a round frame.
          If you have trouble getting an image to upload to the site, make sure that it is named 'artist<?php echo $id ?>.jpg' before upload.">
          <i class="fa fa-info-circle"></i></a></strong></div>  
          <div class="panel-body upload">
            <form action="<?php uploadTo3('../images/'); ?>" method="post" enctype="multipart/form-data">
              <label for="fileToUpload3" class="control-label">Select File</label><br>
                <small class="text-danger">File must be renamed 'artist<?php echo $id ?>.jpg' before uploading here.</small>
              <input type="file" name="fileToUpload3" id="fileToUpload3" class="dropify" data-default-file="../images/artist<?php echo $id ?>.jpg" />
              <button type="submit" class="btn btn-primary btn-lg" name="submit3">Upload File</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col col-md-6">  
        <div class="panel panel-default">   
         <div class="panel-heading"><strong>
            Upload Artist's Displayed Images
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Images" 
          data-content="These images are displayed next to the artist's image on the site. Use a number of images that is appropriate for the flow of the site.
          Every image uploaded here will display in a 'Masonry gallery', which fits them tightly together like tetris when the images have different heights. 
          If you do not want this effect, trim the images completely square. The images may not appear on the site in the same order they are shown here.
          The images can be .jpg, .png, .gif, or .jpeg format.">
          <i class="fa fa-info-circle"></i></a></strong></div>  
          <div class="panel-body upload">
            <form action="<?php uploadTo('../images/artist'.$id.'/displayed/'); ?>" method="post" enctype="multipart/form-data">
              <label for="fileToUpload" class="control-label">Select File</label><br>
                <small class="text-danger">These files will be the ones visible on the gallery next to the artist, as well as the lightbox.</small>
              <input type="file" name="fileToUpload" id="fileToUpload" class="dropify" data-default-file="" />
              <button type="submit" class="btn btn-primary btn-lg" name="submit">Upload File</button>
            </form>
          </div>
     
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
            $files = glob("../images/artist$id/displayed/*");  
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

      <div class="col col-md-6">  
        <div class="panel panel-default">   
         <div class="panel-heading"><strong>
            Upload Artist's NOT Displayed Images
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Images" 
          data-content="These extra images are not displayed on the site, but are included in the 'Lightbox gallery' when an image is selected, 
          along with the images displayed on the site. There is no limit to the amount of images that can be stored here.
          The site does not load them until the Lightbox is used. The images in this directory can be .jpg format only.">
          <i class="fa fa-info-circle"></i></a></strong></div>  
          <div class="panel-body upload">
            <form action="<?php uploadTo2('../images/artist'.$id.'/'); ?>" method="post" enctype="multipart/form-data">
              <label for="fileToUpload2" class="control-label">Select File</label><br>
                <small class="text-danger">These files will be included in the lightbox gallery but not displayed on the page. They must be .jpg file format!</small>
              <input type="file" name="fileToUpload2" id="fileToUpload2" class="dropify" data-default-file="" />
              <button type="submit" class="btn btn-primary btn-lg" name="submit2">Upload File</button>
            </form>
          </div>
     
          <table class="table table-responsive">  
            <?php
            if (array_key_exists('delete_file2', $_POST)) {
            $filename2 = $_POST['delete_file2'];
            if (file_exists($filename2)) {
              unlink($filename2);
              $message = '<div class="alert alert-success" role="alert">File '.$filename2.' deleted.</div>';
            } else {
              $message = '<div class="alert alert-danger" role="alert">Could not delete file '.$filename2.'. File does not exist.</div>';
            }
          }
          $files2 = glob("../images/artist$id/*.jpg");
          foreach ($files2 as $file2) {
            echo "<tr><td>"; 
            echo '<img class="img-thumbnail img-responsive" src="'.$file2.'" width="70%"/></td>';
            echo '<td><form method="post">';
            echo '<input type="hidden" value="'.$file2.'" name="delete_file2" />';
            echo '<input type="submit" class="btn btn-danger delete" value="Delete Image" />';
            echo '</form></td></tr>';
          }
            ?>
          </table>  
        </div>
      </div>
    </div>
  </div>

<?php readfile('includes/footer.html'); ?>