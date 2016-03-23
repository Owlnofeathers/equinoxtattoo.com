<?php
    require 'auth.php';
    include 'includes/header.php';

    $db = new Database();

    if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: userSelect.php');
    }

    $delete_row = $db->delete("DELETE FROM tblUsers WHERE id =" .$id);