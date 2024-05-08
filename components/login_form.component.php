<?php

$login_error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {

    $uname  = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pwd    = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = new User($uname);

    if ($user->exists()) {

        $fetch = $user->get();

        if (password_verify($pwd, $fetch->pwd)) {

            $_SESSION['uname'] = $uname;

        } else {
            $login_error = "<p id='login_error' class='danger result'>Wrong password.</p>";
        }
    } else {
        $login_error = "<p id='login_error' class='danger result'>User doesn't exist.</p>";
    }
}

?>

<div id="login_div" class="popup-form">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="form-header">
            <h2>Sign-in</h2>
            <div class="material-symbols-rounded btn-close" onclick="hideLogin()">close</div>
        </div>

        <?= $login_error ?>

        <input type="text" name="uname" placeholder="Username" minlength="4" pattern="[a-zA-Z0-9+_.]+" required>
        <input type="password" name="pwd" placeholder="Password" minlength="4" required>

        <input class="btn btn-secondary" type="submit" name="signin" value="Signin">

        <div class="line"></div>

        <div class="btn-link" onclick="displayRegister()">Create an account</div>
    </form>
</div>
