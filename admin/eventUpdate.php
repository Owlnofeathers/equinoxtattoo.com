<?php
  session_start();
  require 'auth.php';
  include 'includes/header.php';

  $db = new Database();
?>

<?php
  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: eventSelect.php');
  }

  $enabled = '';
  $heading = '';
  $text = '';
  $buttonSwitch = '';
  $buttonText = '';
  $buttonLink = '';

  if (isset($_POST['submit'])) {
    $ok = true;
    if (!isset($_POST['enabled']) || $_POST['enabled'] === '') {
        $ok = false;
    } else {
        $enabled = mysqli_real_escape_string($db->link, $_POST['enabled']);
    }
    if (!isset($_POST['heading']) || $_POST['heading'] === '') {
        $ok = false;
    } else {
        $heading = mysqli_real_escape_string($db->link, $_POST['heading']);
    }
    if (!isset($_POST['eventText']) || $_POST['eventText'] === '') {
        $ok = false;
    } else {
        $text = mysqli_real_escape_string($db->link, $_POST['eventText']);
    }
    $buttonSwitch = mysqli_real_escape_string($db->link, $_POST['buttonSwitch']);
    $buttonText = mysqli_real_escape_string($db->link, $_POST['buttonText']);
    $buttonLink = mysqli_real_escape_string($db->link, $_POST['buttonLink']);
 
    if ($ok) {
        $events = $db->update("UPDATE tblEvents SET EventSwitch = '$enabled', Heading = '$heading', EventText = '$text', ButtonSwitch = '$buttonSwitch', ButtonText = '$buttonText', ButtonLink = '$buttonLink'
          WHERE id = '$id'");
      }
  } else {
      $events = $db->select("SELECT * FROM tblEvents WHERE id =" .$id);
      foreach ($events as $event) {
          $enabled = $event['EventSwitch'];
          $heading = $event['Heading'];
          $text = $event['EventText'];
          $buttonSwitch = $event['ButtonSwitch'];
          $buttonText = $event['ButtonText'];
          $buttonLink = $event['ButtonLink'];        
        }
  }

?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          Edit Event <?php echo $id ?>
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Edit Event <?php echo $id ?>" 
        data-content="Edit event. If you choose NO for 'Enable Event', the event will be saved, but not displayed on the site.
        Button links must include the entire URL (http://) unless it is pointing to a page in this site (contact.php).">
        <i class="fa fa-info-circle"></i></a></h2>
        <form class="form-horizontal" method="post" action="">
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Enable Event</label>
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
              <button type="submit" name="submit" class="btn btn-default btn-lg">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php readfile('includes/footer.html'); ?>