<?php 
    $user_stats = $user->getUserStats();
    $count = count($user_stats);
?>

<script>
    new Chart(document.getElementById('users'), {
        type: 'line',
        data: {
            labels: [
                <?php
                for ($i=0; $i < $count; $i++) {
                    if (($i + 1) == $count) {
                        echo"'{$user_stats[$i]->day}'";
                    } else {
                        echo"'{$user_stats[$i]->day}', ";
                    }
                }
                ?>
            ],
            datasets: [{
            label: 'Newly Registered Users per day (<?= date('M Y')?>)',
            data: [ 
                <?php
                for ($i=0; $i < ($count); $i++) {
                    if (($i + 1) == $count ) {
                        echo"'{$user_stats[$i]->user}'";
                    } else {
                        echo"'{$user_stats[$i]->user}', ";
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