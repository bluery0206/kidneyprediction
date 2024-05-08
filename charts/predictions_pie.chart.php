<?php 
    $target_stats1 = $upload->getTargetStats();
?>

<script>
    new Chart(document.getElementById('predictions_pie'), {
        type: 'pie',
        data: {
            labels: ['Positive', 'Negative'],
            datasets: [{
                label: ['No. of Positive and Negative Predictions'],
                data: [<?= "'{$target_stats1[0]}'" ?>, <?= "'{$target_stats1[1]}'" ?>],
                borderWidth: 2,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'  
                ],
                borderColor: [ 
                    'rgba(255, 99, 132, 1)', 
                    'rgba(54, 162, 235, 1)'  
                ],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
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