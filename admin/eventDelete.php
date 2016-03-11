<?php
    require 'auth.php';
    include 'includes/navigation.html';

    $message = '';
    if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: eventSelect.php');
    }

    include '../includes/databaseConnection.php';
    $sql = "DELETE FROM tblEvents WHERE id=$id";
    mysqli_query($db, $sql);
    $message = '<div class="alert alert-success" role="alert">Event deleted.</div>';
    mysqli_close($db);

?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-6 text-center">
            <?php
                echo "<p>$message</p>";
            ?>
            </div>
        </div>
    </div>
<?php readfile('includes/footer.html'); ?>