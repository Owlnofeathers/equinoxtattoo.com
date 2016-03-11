<?php
  require 'auth.php';
  include 'includes/navigation.html';
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h2 class="page-header">
          Slider Administration
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Slider Administration" 
        data-content="This is the automatic slide show on the front page of the site. Edit each one from this page.">
        <i class="fa fa-info-circle"></i></a></h2>
        <?php
        include '../includes/databaseConnection.php';
        $sql = 'SELECT * FROM tblSliders';
        $result = mysqli_query($db, $sql);

        echo '
        <table class="table table-responsive table-bordered table-hover">
        <tbody>
        <th bgcolor="#000">
          <td bgcolor="#000"><strong>Enabled</strong></td>
          <td bgcolor="#000"><strong>Heading</strong></td>
          <td bgcolor="#000"><strong>Text</strong></td>
          <td bgcolor="#000"></td>
        </th>
        ';
        foreach ($result as $row) {
            printf('
              
              <tr>
                <td>Slide %s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td><a class="btn btn-default" href="slideUpdate.php?id=%s" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
              </tr>',
              htmlspecialchars($row['id']),
              htmlspecialchars($row['SlideSwitch']),
              htmlspecialchars($row['Heading']),
              htmlspecialchars($row['SlideText']),
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