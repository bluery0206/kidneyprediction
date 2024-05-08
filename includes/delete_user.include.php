<?php

if (isset($_GET['id'])) {

    # Fetch id from url and filter
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);

    # Since this file is not included on the main files,
    # dependencies are included in here.
    include '../classes/db.class.php';
    include '../classes/user.class.php';

    $user = new User();

    # Deletes user based from specified id
    # returns true or error message
    $result = $user->remove($id);

    if ($result) {
        header("Location: ../user_management.php");
    }
}
