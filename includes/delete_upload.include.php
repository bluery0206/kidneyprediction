<?php

if (isset($_GET['id'])) {

    # Fetch id from url and filter
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);

    include '../classes/db.class.php';
    include '../classes/upload.class.php';
    $upload = new Upload();

    # Deletes specified upload id
    # returns true or error message
    $result = $upload->delete($id);

    if ($result) {
        header("Location: ../uploads.php");
    }
}
