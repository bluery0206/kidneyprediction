<?php

if (isset($_GET['id'])) {

    # Fetch id from url and filter

    include '../classes/db.class.php';
    include '../classes/upload.class.php';
    $upload = new Upload();

    # Deletes specified upload id
    # returns true or error message
    $result = $upload->deleteAll();

    if ($result) {
        header("Location: ../uploads.php");
    }
}
