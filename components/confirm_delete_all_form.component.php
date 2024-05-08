<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {

    $add_user = new User($_SESSION['uname']);

    if ($add_user->removeAll()) {

    } else {
        $add_user_error = "<p id='add_user_error' class='danger result'>There was an error during registration.</p>";
    }
}

?>

<div id="confirm_delete_all_div" class="popup-form">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="form-header">
            <h2>Confirm Delete All?</h2>

            <div class="btn btn-close material-symbols-rounded btn" onclick="hideConfirmDeleteAll()">close</div>
        </div>

        <input class="predict_btn" type="submit" name="confirm_delete" value="Confirm Delete All">
    </form>
</div>
