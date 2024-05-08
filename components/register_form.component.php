<?php

$register_error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    # Fetch inputs from signup form and filter
    $lname  = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mname  = filter_input(INPUT_POST, 'mname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname  = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $utype  = filter_input(INPUT_POST, 'utype', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $uname  = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pwd    = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $c_pwd  = filter_input(INPUT_POST, 'c_pwd', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = new User($uname);

    if(!$user->exists()){

        if ($pwd === $c_pwd) {

            $pwd = password_hash($pwd, PASSWORD_DEFAULT);

            if ($user->save($lname, $mname, $fname, $utype, $uname, $pwd)) {

                $_SESSION['uname'] = $uname;

            } else {
                $register_error = "<p id='register_error' class='danger result'>There was an error during registration.</p>";
            }
        } else {
            $register_error = "<p id='register_error' class='danger result'>Password don't match.</p>";
        }
    } else {
        $register_error = "<p id='register_error' class='danger result'>Username already taken.</p>";
    }
}
?>

<div id="register_div" class="popup-form">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="form-header">
            <h2>Register</h2>

            <div class="material-symbols-rounded btn-close" onclick="hideRegister()">close</div>
        </div>

        <?= $register_error ?>

        <input type="text" name="fname" placeholder="First Name" minlength="4" pattern="[a-zA-Z ]+" required>
        <input type="text" name="mname" placeholder="Middle Name/Initial" minlength="1" pattern="[a-zA-Z. ]+" required>
        <input type="text" name="lname" placeholder="Last Name" minlength="4" pattern="[a-zA-Z ]+" required>

        <select name="utype">
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>

        <input type="text" name="uname" placeholder="Username" minlength="4" pattern="[a-zA-Z0-9_.]+" required>
        <input type="password" name="pwd" placeholder="Password" minlength="4" required>
        <input type="password" name="c_pwd" placeholder="Confirm Password" minlength="4" required>

        <input class="btn btn-secondary" type="submit" name="register" value="Create account">
    </form>
</div>
