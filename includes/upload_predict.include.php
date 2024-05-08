<?php

$upload_error = null;
$predicted = null;
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_predict'])) {

    # Fetch inputs from predict form and filter
    $specific_gravity       = filter_input(INPUT_POST, 'specific_gravity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ph                     = filter_input(INPUT_POST, 'ph', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $osmolarity             = filter_input(INPUT_POST, 'osmolarity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $conductivity           = filter_input(INPUT_POST, 'conductivity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $urea_concentration     = filter_input(INPUT_POST, 'urea_concentration', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $calcium_concentration  = filter_input(INPUT_POST, 'calcium_concentration', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    # gravity, ph, osmo, cond, urea, calc
    $predicted = shell_exec("py bridge.py $specific_gravity $ph $osmolarity $conductivity $urea_concentration $calcium_concentration");

    $upload = new Upload();
    $upload_log = new Logs();

    $upload_users = new User();
    $upload_uid = 0;
    $uid = $upload_users->getFromID($upload_uid);
    while ($uid != false) {
        $upload_uid += 1;
    }

    $result = $upload->save($specific_gravity, $ph, $osmolarity, $conductivity, $urea_concentration, $calcium_concentration, $predicted);

    if ($result) {
        $upload_error = "<p id='upload_error' class='success'>Upload successfuly</p>";
        $upload_log->insert($_SESSION['uname'] ?? "anon_$upload_uid", 'upload');

    } else {
        $upload_error = "<p id='upload_error' class='error'>$result</p>";
    }
}
