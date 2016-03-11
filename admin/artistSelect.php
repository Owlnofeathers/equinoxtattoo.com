<?php
  require 'auth.php';
  include 'includes/navigation.html';
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h2 class="page-header">
          Artist Administration
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Gallery Administration" 
        data-content="Review and edit the artist information from here. Artist number determines their order on the page from the top.">
        <i class="fa fa-info-circle"></i></a></h2>
        
        <?php
          include '../includes/databaseConnection.php';
          $sql = 'SELECT * FROM tblArtists';
          $result = mysqli_query($db, $sql);

          echo '
          <table class="table table-responsive table-bordered table-hover">
            <tbody>
              <th bgcolor="#000">
                <td bgcolor="#000"><strong>Enabled</strong></td>
                <td bgcolor="#000"><strong>Artist\'s Name</strong></td>
                <td bgcolor="#000"><strong>Artist\'s Price</strong></td>
                <td bgcolor="#000"><strong>Artist Description</strong></td>
                <td bgcolor="#000"></td>
              </th>
          ';
          foreach ($result as $row) {
              printf('
                
                <tr>
                  <td>Artist %s</td>
                  <td>%s</td>
                  <td>%s</td>
                  <td>%s</td>
                  <td>%s</td>
                  <td><a class="btn btn-default" href="artistUpdate.php?id=%s" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
                </tr>',
                htmlspecialchars($row['id']),
                htmlspecialchars($row['ArtistSwitch']),
                htmlspecialchars($row['Name']),
                htmlspecialchars($row['Price']),
                htmlspecialchars($row['Description']),
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