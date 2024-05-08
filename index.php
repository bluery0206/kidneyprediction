<?php

$add_user_error = null;

session_start();

include "classes/db.class.php";
include "classes/upload.class.php";
include "classes/auth.class.php";
include "classes/user.class.php";
include "classes/logs.class.php";

$auth   = new Auth();
$upload = new Upload();
$user   = new User();

include 'includes/upload_predict.include.php';

include "components/upload_dataset.component.php";
include "components/add_user_form.component.php";
include 'components/register_form.component.php';
include 'components/login_form.component.php';


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="functions.js"></script>
    <title>Kidney Stone Prediction</title>
</head>

<body id="index">
    <main>
        <div class="left">
            <div class="top">
                <h2>Kidney Stone Prediction</h2>
                <p class="desc">A WebApp that uses LinearRegression to identify if an individual most likely have kidney stones or not based on these inputs:</p>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                    <div class="input-group">
                        <div class="input-field">
                            <div class="input-label">
                                <label for="specific_gravity">Specific Gravity</label>
                                <span class="desc material-symbols-rounded" title="Specific Gravity - the density of the urine relative to water.">info</span>
                            </div>
                            <input type="number" name="specific_gravity" id="specific_gravity" placeholder="0.00" step="any" required>
                        </div>

                        <div class="input-field">
                            <div class="input-label">
                                <label for="ph">pH</label>
                                <span class="desc material-symbols-rounded" title="pH - the negative logarithm of the hydrogen ion.">info</span>
                            </div>
                            <input type="number" name="ph" id="ph" placeholder="0.00" step="any" required>
                        </div>

                        <div class="input-field">
                            <div class="input-label">
                                <label for="osmolarity">Osmolarity</label>
                                <span class="desc material-symbols-rounded" title="Osmolarity - is proportional to the concentration of molecules in solution (urine).">info</span>
                            </div>
                            <input type="number" name="osmolarity" id="osmolarity" placeholder="0.00" step="any" required>
                        </div>

                        <div class="input-field">
                            <div class="input-label">
                                <label for="conductivity">Conductivity</label>
                                <span class="desc material-symbols-rounded" title="Conductivity - is proportional to the concentration of charged ions in solution.">info</span>
                            </div>
                            <input type="number" name="conductivity" id="conductivity" placeholder="0.00" step="any" required>
                        </div>

                        <div class="input-field">
                            <div class="input-label">
                                <label for="urea_concentration">Urea Concentration</label>
                                <span class="desc material-symbols-rounded" title="Urea Concentration - is the balance between urea production in the liver and urea elimination by the kidneys, in urine">info</span>
                            </div>
                            <input type="number" name="urea_concentration" id="urea_concentration" placeholder="0.00" step="any" required>
                        </div>

                        <div class="input-field">
                            <div class="input-label">
                            <label for="calcium_concentration">Calcium Concentration</label>
                                <span class="desc material-symbols-rounded" title="Calcium Concentration (millimoles/litre)- the amount of calcium in urine.">info</span>
                            </div>
                            <input type="number" name="calcium_concentration" id="calcium_concentration" placeholder="0.00" step="any" required>
                        </div>
                    </div>

                    <input class="btn btn-secondary" type="submit" name="submit_predict" value="Predict">
                </form>
                
                <?php if ($predicted != null) { ?>

                    <div class="result-div">
                        <h4>The model predicted:</h4>

                        <?php
                            if ($predicted == 1) {
                                ?>

                                    <p class="danger result">Positive</p>

                                <?php
                            } else if ($predicted == 0) {
                                ?>

                                    <p class="green result">Negative</p>

                                <?php
                            }
                        ?>

                        <p class="desc"><em>PS: The model's prediction is not always right nor should be considered true. If concerned, please refer to your doctor for accurate diagnosis.</em></p>
                    </div>

                <?php } ?>

            </div>

            <p class="desc">Created by: Mark Ryan Hilario BSCS 3-A</p>
        </div>
        <div class="right">
            
            <?php include 'components/nav.component.php' ?>
            
            <div class="graphs">
                <div class="graph">
                    <canvas id="pred_per_day"></canvas>
                </div>
                <div class="graph">
                    <canvas id="predictions"></canvas>
                </div>
                <div class="graph">
                    <canvas id="predictions_pie"></canvas>
                </div>
                <div class="graph">
                    <canvas id="users"></canvas>
                </div>
                <div class="graph">
                    <canvas id="top_contributors"></canvas>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

<?php 
    include "charts/pred_per_day.chart.php";
    include "charts/predictions.chart.php";
    include "charts/users.chart.php";
    include "charts/logs.chart.php";
    include "charts/predictions_pie.chart.php";
?>
<script>
    showLoginError();
    showRegisterError();
    showAddUserError();
</script>