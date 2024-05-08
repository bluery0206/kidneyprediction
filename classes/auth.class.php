<?php

class Auth extends Db {

    public function loggedin() {

        if (isset($_SESSION['uname']) && !empty($_SESSION['uname'])) {

            return true;

        } else {
            return false;
        }
    }
}
