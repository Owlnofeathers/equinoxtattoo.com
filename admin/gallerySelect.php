<?php
  require 'auth.php';
  include 'includes/header.php';

  $db = new Database();
  $ga = new Gallery();

  $galleries = $db->select($ga->getAllGalleries());
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h2 class="page-header">
          Gallery Administration
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Gallery Administration" 
        data-content="Review and edit the gallery information from here.">
        <i class="fa fa-info-circle"></i></a></h2>

        <table class="table table-responsive table-bordered table-hover">
          <tbody>
            <th bgcolor="#000">
              <td bgcolor="#000"><strong>Enabled</strong></td>
              <td bgcolor="#000"><strong>Artist\'s Name</strong></td>
              <td bgcolor="#000"><strong>Artist\'s Contact</strong></td>
              <td bgcolor="#000"><strong>Gallery Description</strong></td>
              <td bgcolor="#000"></td>
            </th>

            <?php foreach ($galleries as $gallery) : ?>
              <tr>
                <td>Gallery <?php echo $gallery['id']; ?></td>
                <td><?php echo $gallery['GallerySwitch']; ?></td>
                <td><?php echo $gallery['GalleryName']; ?></td>
                <td><?php echo $gallery['GalleryLink']; ?></td>
                <td><?php echo $gallery['GalleryText']; ?></td>
                <td><a class="btn btn-default" href="galleryUpdate.php?id=<?php echo $gallery['id']; ?>" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
              </tr>
            <?php endforeach; ?>

        </tbody></table>
      </div>
    </div>
 </div>

    <?php readfile('includes/footer.html'); ?>