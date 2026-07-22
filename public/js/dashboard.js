const graphique = document.getElementById('graphique-commandes');

if (graphique) {
    const labels = JSON.parse(graphique.dataset.labels);
    const valeurs = JSON.parse(graphique.dataset.valeurs);

    new Chart(graphique, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de commandes',
                data: valeurs,
                backgroundColor: '#AA3012',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
}
