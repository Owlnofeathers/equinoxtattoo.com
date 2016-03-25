<?php
  require 'auth.php';
  require 'includes/password.php'; 
  include 'includes/header.php';

  $db = new Database();
  $us = new User();

  if (isset($_POST['submit'])) {
    $ok = true;
    if (!isset($_POST['name']) || $_POST['name'] === '') {
        $ok = false;
    } else {
        $name = mysqli_real_escape_string($db->link, $_POST['name']);
    }
    if (!isset($_POST['password']) || $_POST['password'] === '') {
        $ok = false;
    } else {
        $password = mysqli_real_escape_string($db->link, $_POST['password']);
    }
    if (!isset($_POST['confirmPassword']) || $_POST['confirmPassword'] === '') {
        $ok = false;
    } else {
        $confirmPassword = mysqli_real_escape_string($db->link, $_POST['confirmPassword']);
    }
    if (!isset($_POST['isAdmin']) || $_POST['isAdmin'] === '') {
        $ok = false;
    } else {
        $setAdmin = mysqli_real_escape_string($db->link, $_POST['isAdmin']);
    }

    if ($ok) {
        $checkUsername = $db->select($us->getUserByName($name));
        if (mysqli_num_rows($checkUsername) > 0) {
           $message = '<div class="alert alert-danger" role="alert">User name already exists.</div>';

        } else { 
        	if ($password != $confirmPassword){
        		$message = '<div class="alert alert-danger" role="alert">Passwords must match!.</div>';
        	} else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // add database code here
            $insert_row = $db->insert($us->insertUser($name, $hash, $setAdmin)); 
            $message = '<div class="alert alert-success" role="alert">User added.</div>';   
            }     
            
        }
    }
}
?>
<body>
<div class="container">
	<div class="row">
	  <div class="col-md-6">
	  	<h2 class="page-header">
	  		New User
	  	<a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="New User" 
        data-content="Add the username and the password which will be used to log into the site.
        Only new users with  'Set As Admin' set to 'Yes' can access the site.">
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
			    <label for="password" class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-6">
			      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
			    </div>
			 </div>
			 <div class="form-group">
			    <label for="confirmPassword" class="col-sm-3 control-label">Confirm</label>
			    <div class="col-sm-6">
			      <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
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
		        <button type="submit" name="submit"class="btn btn-default btn-lg">Submit</button>
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