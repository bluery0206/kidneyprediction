<?php 
    $logs = new Logs();
    $logs_stats = $logs->getLogsStats();
    $logs_count = count($logs_stats);
?>

<script>
    new Chart(document.getElementById('top_contributors'), {
        type: 'bar',
        data: {
            labels: [
                <?php
                for ($i=1; $i < $logs_count; $i++) {
                    echo"'{$logs_stats[$i]->uname}', ";
                }
                ?>
            ],
            datasets: [{
            label: 'Top Predictors (<?= date('M Y')?>)',
            data: [ 
                <?php
                for ($i=0; $i < ($logs_count); $i++) {
                    echo"'{$logs_stats[$i]->total_uploads}', ";
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