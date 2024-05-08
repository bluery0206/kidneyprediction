<?php

$edit_user_error = null;

if (htmlspecialchars($_SERVER['REQUEST_METHOD']) === "POST" && isset($_POST['edit_user'])) {

  # filtering variables and values for security
  $lname  = filter_input(INPUT_POST, "edit_lname", FILTER_SANITIZE_SPECIAL_CHARS);
  $mname  = filter_input(INPUT_POST, "edit_mname", FILTER_SANITIZE_SPECIAL_CHARS);
  $fname  = filter_input(INPUT_POST, "edit_fname", FILTER_SANITIZE_SPECIAL_CHARS);
  $utype  = filter_input(INPUT_POST, "edit_utype", FILTER_SANITIZE_SPECIAL_CHARS);
  $uname  = filter_input(INPUT_POST, "edit_uname", FILTER_SANITIZE_SPECIAL_CHARS);
  $id     = filter_input(INPUT_POST, "edit_id", FILTER_SANITIZE_SPECIAL_CHARS);

  # User object creation for easy reuse of methods
  $user = new User();

  $res = $user->edit($lname, $mname, $fname, $utype, $uname, $id);
}

?>

<div id="edit_user_div_<?= $user[$i]->id?>" class="popup-form">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="form-header">
            <h2>Edit user (<?= $user[$i]->uname?>)</h2>

            <div class="btn btn-close material-symbols-rounded btn" onclick="hideEditUsers(<?= $user[$i]->id?>)">close</div>
        </div>

        <?= $edit_user_error ?>

        <input type="text" name="edit_fname" placeholder="First Name" minlength="2" pattern="[a-zA-Z ]+" value="<?= $user[$i]->fname ?>" required>
        <input type="text" name="edit_mname" placeholder="Middle Name" minlength="2" pattern="[a-zA-Z. ]+" value="<?= $user[$i]->mname ?>" required>
        <input type="text" name="edit_lname" placeholder="Last Name" minlength="2" pattern="[a-zA-Z ]+" value="<?= $user[$i]->lname ?>" required>

        <select name="edit_utype">
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>

        <input type="text" name="edit_uname" placeholder="Username" minlength="4" pattern="[a-zA-Z0-9_.]+" value="<?= $user[$i]->uname ?>" required>
        <input type="text" name="edit_id" value="<?= $user[$i]->id ?>" hidden>

        <input class="predict_btn" type="submit" name="edit_user" value="Save changes">
    </form>
</div>
