<?php
    $upload_stats = $upload->getUploadStats();
?>

<script>
    new Chart(document.getElementById('pred_per_day'), {
        type: 'line',
        data: {
            labels: [
                <?php
                for ($i=1; $i < (count($upload_stats)); $i++) {
                    if (($i+1) == count($upload_stats)) {
                        echo"'Today'";
                    } else {
                        echo"'{$upload_stats[$i]->day}', ";
                    }
                }
                ?>
            ],
            datasets: [{
            label: 'Predictions per day (<?= date('M Y')?>)',
            data: [ 
                <?php
                for ($i=0; $i < (count($upload_stats)); $i++) {
                    if (($i+1) == count($upload_stats)) {
                        echo"'{$upload_stats[$i]->users}'";
                    } else {
                        echo"'{$upload_stats[$i]->users}', ";
                    }
                }
                ?>
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            backgroundColor: 'rgb(75, 192, 192)',
            }]
        },
        options: {
            scales: {
                y: {
                    grid: {
                    color: 'rgb(100,100,100)'
                    }
                },
                x: {
                    grid: {
                    color: 'rgb(100,100,100)'
                    }
                }
            }
        }
        });
</script>