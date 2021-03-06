<?php
  session_start();
  require 'auth.php';
  require 'includes/password.php'; 
  include 'includes/header.php';

  $db = new Database();
  $us = new User();

  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: userSelect.php');
  }

  if (isset($_POST['submit'])) {
    $ok = true;
    if (!isset($_POST['name']) || $_POST['name'] === '') {
        $ok = false;
    } else {
        $name = mysqli_real_escape_string($db->link, $_POST['name']);
    }
    if (!isset($_POST['isAdmin']) || $_POST['isAdmin'] === '') {
        $ok = false;
    } else {
        $setAdmin = mysqli_real_escape_string($db->link, $_POST['isAdmin']);
    }
   
    if ($ok) {
        $update_row = $db->update($us->updateUser($name, $setAdmin, $id));
      }

  } else {
      $usrs = $db->select($us->getUserById($id));

      foreach ($usrs as $usr) {
          $name = $usr['Name'];
          $setAdmin = $usr['isAdmin'];
      }
  }

// password change section

 if (isset($_POST['submit2'])) {

    if (isSet($_POST['password']) && isSet($_POST['newPassword']) && isSet($_POST['confirmPassword']) 
        && $_POST['password'] != '' && $_POST['newPassword'] != '' && $_POST['confirmPassword'] != '') { 
        $newPassword = $_POST['newPassword'];
        $confirm = $_POST['confirmPassword'];
        
        if ($newPassword == $confirm) {
          $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
          $password = $_POST['password'];
          $password = password_hash($password, PASSWORD_DEFAULT);
    
          $passes = $db->select($us->getPasswordById($id));
          $pass = $passes->fetch_assoc(); 
          if ($pass) {
            $hash = $pass['Password'];
            if (password_verify($_POST['password'], $hash)) {
              $update_row = $db->update($us->updatePassword($newPassword, $id));
          } else 
              $message = '<div class="alert alert-danger" role="alert">Incorrect password.</div>';

        } else 
            $message = '<div class="alert alert-danger" role="alert">Confirm password needs to match.</div>';
     }
   }
}

?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="page-header">
          Edit User
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Edit User" 
        data-content="You can edit the user name they use to log in, and the admin status. Admin set to No means the account stays but they cannot log in.">
        <i class="fa fa-info-circle"></i></a></h2>
        <form class="form-horizontal" method="post" action="">
          <div class="form-group">
            <label for="username" class="col-sm-3 control-label">User Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="username" name="name" value="<?php
                echo htmlspecialchars($name);
                ?>" placeholder="User name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Set As Admin?</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($setAdmin === '0') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="isAdmin" id="radio1" value="0" <?php
                    if ($setAdmin === '0') {
                        echo ' checked';
                    }
                ?>>No
              </label>
              <label class="btn btn-primary <?php
                    if ($setAdmin === '1') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="isAdmin" id="radio2" value="1" <?php
                    if ($setAdmin === '1') {
                        echo ' checked';
                    }
                ?>> Yes
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
              <button type="submit" name="submit" class="btn btn-default btn-lg">Submit</button>
            </div>
          </div>
        </form>

        <!-- password change section -->
        <form class="form-horizontal" method="post" action="">
         <h3 class="page-header">
            Change Password
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Change Password" 
          data-content="Password can be changed after entering current password and confirming the new one.">
          <i class="fa fa-info-circle"></i></a></h3>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" id="password" name="password"  placeholder="Current Password">
            </div>
          </div>
          <div class="form-group">
            <label for="newPassword" class="col-sm-3 control-label">New password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
            </div>
          </div>
          <div class="form-group">
            <label for="confirmPassword" class="col-sm-3 control-label">Confirm</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password">
            </div>
          </div> 
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
              <button type="submit" name="submit2" class="btn btn-default btn-lg">Submit</button>
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