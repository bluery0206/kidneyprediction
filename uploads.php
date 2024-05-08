<?php

session_start();

include "classes/db.class.php";
include "classes/auth.class.php";
include "classes/upload.class.php";
include "classes/user.class.php";

include "includes/delete_upload.include.php";

include "components/upload_dataset.component.php";
include "components/add_user_form.component.php";

$auth = new Auth();
$upload = new Upload();

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="functions.js"></script>
    <title>View Uploads | Kidney Stone Prediction</title>
</head>

<body>
    <main class="table-page">
        <?php include 'components/nav.component.php' ?>
        
        <div class="table_div">
            <div class="table-header">
                <h2>Uploads</h2>
                <div class="nav">
                    <button class="btn btn-nav" onclick="displayUploadCSV()">Upload CSV file</button>
                    <button class="btn btn-nav danger" onclick="displayConfirmDeleteAllCSV()">Delete All</button>
                </div>
            </div>

            <?php
            $uploads = $upload->get();

            if (!empty($uploads)) {
            ?>

                <table>
                    <tr>
                        <th>Date Added</th>
                        <th>ID</th>
                        <th>Specicific<br>Gravity</th>
                        <th>Osmolarity</th>
                        <th>Conductivity</th>
                        <th>Urea<br>Concentration</th>
                        <th>Calcium<br>Concentration</th>
                        <th>Predicted</th>
                        <th>Actions</th>
                    </tr>

                    <?php for ($i = 0; $i < count($uploads); $i++) { ?>

                        <tr>
                            <td><?= $uploads[$i]->date_added ?></td>
                            <td><?= $uploads[$i]->id ?></td>
                            <td><?= $uploads[$i]->specific_gravity ?></td>
                            <td><?= $uploads[$i]->osmolarity ?></td>
                            <td><?= $uploads[$i]->conductivity ?></td>
                            <td><?= $uploads[$i]->urea_concentration ?></td>
                            <td><?= $uploads[$i]->calcium_concentration ?></td>
                            <td><?= $uploads[$i]->predicted ?></td>
                            <td class="actions">
                                <!-- <a class="btn green" href="includes/delete_upload.include.php?id=<?= $uploads[$i]->id ?>">Delete</a> -->
                                <a class="btn danger" href="includes/delete_upload.include.php?id=<?= $uploads[$i]->id ?>">Delete</a>
                            </td>
                        </tr>

                    <?php } ?>

                </table>

            <?php } else { ?>

                <h2>The upload dataset is currently empty.</h2>

            <?php } ?>

        </div>
    </main>
</body>
</html>
