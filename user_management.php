<?php

$add_user_error = null;

session_start();

include "classes/db.class.php";
include "classes/auth.class.php";
include "classes/upload.class.php";
include "classes/user.class.php";

include "includes/delete_upload.include.php";

include "components/confirm_delete_all_form.component.php";
include "components/upload_dataset.component.php";
include "components/add_user_form.component.php";

$loggedin = new User($_SESSION['uname']);
$loggedin = $loggedin->get();

$auth = new Auth();

$users = new User();
$user = $users->getAll();


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="functions.js"></script>
    <title>User Management | Kidney Stone Prediction</title>
</head>

<body>
    <main class="table-page">
        <?php include 'components/nav.component.php';?>

        <div class="table_div">
            <div class="table-header">
                <h2>Users</h2>
                <div class="nav">
                    <button class="btn btn-nav" onclick="displayAddUsers()">Add new user</button>
                    <button class="btn btn-nav danger" onclick="displayConfirmDeleteAll()">Delete All</button>
                </div>
            </div>

            <?php if (count($user) > 1) { ?>

                <table>
                    <tr>
                        <th>ID</th>
                        <th>Reg Date</th>
                        <th>Last</th>
                        <th>Middle</th>
                        <th>First</th>
                        <th>Type</th>
                        <th>Username</th>
                        
                        <?php if ($loggedin->utype == 1) { ?> 

                            <th>Actions</th>
        
                        <?php } ?>

                    </tr>

                    <?php
                    for ($i = 0; $i < count($user); $i++) {
                        include 'components/edit_user_form.component.php';
                      if ($user[$i]->uname === $_SESSION['uname']) {
                        continue;
                      }
                      else {

                    ?>

                        <tr>
                            <td><?= $user[$i]->id ?></td>
                            <td><?= $user[$i]->reg_date ?></td>
                            <td><?= $user[$i]->lname ?></td>
                            <td><?= $user[$i]->mname ?></td>
                            <td><?= $user[$i]->fname ?></td>
                            <td><?php echo ($user[$i]->utype == 1) ? "Admin" : "User" ?></td>
                            <td><?= $user[$i]->uname ?></td>
                            
                            <?php if ($loggedin->utype == 1) { ?> 

                                <td>
                                    <button class="btn green" onclick="displayEditUsers(<?= $user[$i]->id ?>)">Edit</button>
                                    <a class="btn danger" href="includes/delete_user.include.php?id=<?= $user[$i]->id ?>">Delete</a>
                                </td>
        
                            <?php } ?>

                        </tr>

                    <?php }  } ?>

                </table>

            <?php } else { ?>

                <h2>The user dataset is currently empty.</h2>

            <?php } ?>

        </div>
    </main>
</body>
</html>
