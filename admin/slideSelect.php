<?php
  require 'auth.php';
  include 'includes/header.php';

  $db = new Database();
  $slides = $db->select("SELECT * FROM tblSliders");
?>

  <div class="container">
    <div class="row">
      <div class="col col-md-12">
        <h2 class="page-header">
          Slider Administration
        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Slider Administration" 
        data-content="This is the automatic slide show on the front page of the site. Edit each one from this page.">
        <i class="fa fa-info-circle"></i></a></h2>

        <table class="table table-responsive table-bordered table-hover">
        <tbody>
        <th bgcolor="#000">
          <td bgcolor="#000"><strong>Enabled</strong></td>
          <td bgcolor="#000"><strong>Heading</strong></td>
          <td bgcolor="#000"><strong>Text</strong></td>
          <td bgcolor="#000"></td>
        </th>

        <?php foreach ($slides as $slide) : ?> 
          <tr>
            <td>Slide <?php echo htmlspecialchars($slide['id']); ?></td>
            <td><?php echo htmlspecialchars($slide['SlideSwitch']); ?></td>
            <td><?php echo htmlspecialchars($slide['Heading']); ?></td>
            <td><?php echo htmlspecialchars($slide['SlideText']); ?></td>
            <td><a class="btn btn-default" href="slideUpdate.php?id=<?php echo $slide['id']; ?>" role="button"><i class="fa fa-pencil"></i> Edit</a></td>
          </tr>
         <?php endforeach; ?>
 
		</tbody></table>
      </div>
    </div>
  </div>

  <?php readfile('includes/footer.html'); ?>