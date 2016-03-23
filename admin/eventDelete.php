<?php
    require 'auth.php';
    include 'includes/header.php';

    $db = new Database();

    $message = '';
    if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: eventSelect.php');
    }

    $delete_row = $db->delete("DELETE FROM tblEvents WHERE id=" .$id);