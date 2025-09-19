document.addEventListener("DOMContentLoaded", () => {

    // Commodity chart
    new Chart(document.getElementById('commodityChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: window.chartData.commodities.labels,
            datasets: [{
                label: 'No. of Records',
                data: window.chartData.commodities.values,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Type of Technology chart
    new Chart(document.getElementById('techTypeChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: window.chartData.techTypes.labels,
            datasets: [{
                data: window.chartData.techTypes.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(201, 203, 207, 0.6)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // IP Status chart
    new Chart(document.getElementById('ipStatusChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: window.chartData.ipStatuses.labels,
            datasets: [{
                data: window.chartData.ipStatuses.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // TRL Level chart
    new Chart(document.getElementById('trlLevelChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: window.chartData.trlLevels.labels,
            datasets: [{
                label: 'No. of Records',
                data: window.chartData.trlLevels.values,
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Priority Area chart
    new Chart(document.getElementById('priorityChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: window.chartData.priorities.labels,
            datasets: [{
                data: window.chartData.priorities.values,
            backgroundColor: [
                'rgba(75, 192, 192, 0.6)',  // Teal
                'rgba(255, 159, 64, 0.6)',  // Orange
                'rgba(201, 203, 207, 0.6)', // Gray
                'rgba(54, 162, 235, 0.6)',  // Blue
                'rgba(255, 99, 132, 0.6)',  // Red
                'rgba(153, 102, 255, 0.6)', // Purple
                'rgba(255, 205, 86, 0.6)'   // Yellow
            ],

                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

});
