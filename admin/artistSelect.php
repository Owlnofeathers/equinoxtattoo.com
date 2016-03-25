<?php
  require 'auth.php';
  include 'includes/header.php';

  $db = new Database();
  $ar = new Artist();

  $artists = $db->select($ar->getAllArtists());
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h2 class="page-header">
          Artist Administration
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Gallery Administration" 
        data-content="Review and edit the artist information from here. Artist number determines their order on the page from the top.">
        <i class="fa fa-info-circle"></i></a></h2>

        <table class="table table-responsive table-bordered table-hover">
          <tbody>
            <th bgcolor="#000">
              <td bgcolor="#000"><strong>Enabled</strong></td>
              <td bgcolor="#000"><strong>Artist's Name</strong></td>
              <td bgcolor="#000"><strong>Artist's Price</strong></td>
              <td bgcolor="#000"><strong>Artist Description</strong></td>
              <td bgcolor="#000"></td>
            </th>

            <?php foreach ($artists as $artist) : ?>               
              <tr>
                <td><?php echo htmlspecialchars($artist['id']); ?></td>
                <td><?php echo htmlspecialchars($artist['ArtistSwitch']); ?></td>
                <td><?php echo htmlspecialchars($artist['Name']); ?></td>
                <td><?php echo htmlspecialchars($artist['Price']); ?></td>
                <td><?php echo htmlspecialchars($artist['Description']); ?></td>
                <td><a class="btn btn-default" href="artistUpdate.php?id=<?php echo htmlspecialchars($artist['id']); ?>" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
              </tr>
            <?php endforeach; ?>

          </tbody></table>
      </div>
    </div>
 </div>

<?php readfile('includes/footer.html'); ?>