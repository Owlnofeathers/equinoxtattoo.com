<?php
    require 'auth.php';
    include 'includes/header.php';

    $db = new Database();
    $us = new User();

    if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: userSelect.php');
    }

    $delete_row = $db->delete($us->deleteUser($id));