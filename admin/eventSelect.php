<?php
  require 'auth.php';
  include 'includes/header.php';
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h2 class="page-header">
          Event Section Administration
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Event Administration" 
        data-content="Review and edit the event information from here. There can be as many events saved here as you like,
        but only the events 'Enabled = 1' will be displayed on the site. If you select 'Delete', it's GONE! 
        Choose the amount of 'Enabled' events which is appropriate to display on the home page. 
        If you would like to add a new event, select 'Events', then 'New Event' from the navigation bar.">
        <i class="fa fa-info-circle"></i></a></h2>
        <?php
          include '../includes/databaseConnection.php';
          $sql = 'SELECT * FROM tblEvents';
          $result = mysqli_query($db, $sql);

          echo '
          <table class="table table-responsive table-bordered table-hover">
          <tbody>
          <th bgcolor="#000">
            <td bgcolor="#000"><strong>Enabled</strong></td>
            <td bgcolor="#000"><strong>Heading</strong></td>
            <td bgcolor="#000"><strong>Text</strong></td>
            <td bgcolor="#000"></td>
            <td bgcolor="#000"></td>
          </th>
          ';
          foreach ($result as $row) {
              printf('
                
                <tr>
                  <td>Event %s</td>
                  <td>%s</td>
                  <td>%s</td>
                  <td>%s</td>
                  <td><a class="btn btn-default" href="eventUpdate.php?id=%s" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a class="btn btn-danger delete" href="eventDelete.php?id=%s" role="button"><i class="fa fa-trash-o"></i> Delete</a></td>
                </tr>',
                htmlspecialchars($row['id']),
                htmlspecialchars($row['EventSwitch']),
                htmlspecialchars($row['Heading']),
                htmlspecialchars($row['EventText']),
                htmlspecialchars($row['id']),
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