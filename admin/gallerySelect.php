<?php
  require 'auth.php';
  include 'includes/header.php';
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h2 class="page-header">
          Gallery Administration
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Gallery Administration" 
        data-content="Review and edit the gallery information from here.">
        <i class="fa fa-info-circle"></i></a></h2>
        <?php
        include '../includes/databaseConnection.php';
        $sql = 'SELECT * FROM tblGallery';
        $result = mysqli_query($db, $sql);

        echo '
        <table class="table table-responsive table-bordered table-hover">
          <tbody>
            <th bgcolor="#000">
              <td bgcolor="#000"><strong>Enabled</strong></td>
              <td bgcolor="#000"><strong>Artist\'s Name</strong></td>
              <td bgcolor="#000"><strong>Artist\'s Contact</strong></td>
              <td bgcolor="#000"><strong>Gallery Description</strong></td>
              <td bgcolor="#000"></td>
            </th>
        ';
        foreach ($result as $row) {
            printf('
              
              <tr>
                <td>Gallery %s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td><a class="btn btn-default" href="galleryUpdate.php?id=%s" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
              </tr>',
              htmlspecialchars($row['id']),
              htmlspecialchars($row['GallerySwitch']),
              htmlspecialchars($row['GalleryName']),
              htmlspecialchars($row['GalleryLink']),
              htmlspecialchars($row['GalleryText']),
              htmlspecialchars($row['id'])
            );
        }
        echo '</tbody></table>';

        mysqli_close($db);

        ?>
      </div>
    </div>

 </div>

    <?php readfile('includes/footer.html'); ?>