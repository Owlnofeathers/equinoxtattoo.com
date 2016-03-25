<?php
  require 'auth.php';
  include 'includes/header.php';

  $db = new Database();
  $us = new User();

  $usrs = $db->select($us->getAllUsers());
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-6">
        <h2 class="page-header">
          User Administration 
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="User Administration" 
          data-content="Use this page to edit or delete current 'users'. Only users with Admin=1 may log into the page. 
          If you want to keep the user and password, but don't want them to be able to log in, Change 'Admin' to '0'. 
          If you want to add a new user, select 'Users', then 'New User' in the navigation bar.">
          <i class="fa fa-info-circle"></i></a></h2>

          <table class="table table-hover">
          <tbody>
          
          <?php foreach ($usrs as $usr) : ?>
            <tr>
              <td><i class="fa fa-user"></i> <?php echo htmlspecialchars($usr['Name']); ?></td>
              <td>Admin = <?php echo htmlspecialchars($usr['isAdmin']); ?></td>
              <td><a class="btn btn-default" href="userUpdate.php?id=<?php echo $usr['id']; ?>" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
              <td><a class="btn btn-danger delete" href="userDelete.php?id=<?php echo $usr['id']; ?>" role="button"><i class="fa fa-trash-o"></i> Delete</a></td>
            </tr>
          <?php endforeach; ?>

        </tbody></table>
      </div>
    </div>
  </div>

  <?php readfile('includes/footer.html'); ?>