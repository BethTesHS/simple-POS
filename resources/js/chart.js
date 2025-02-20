
const chartColors = ['#4e73df', '#1cc88a', '#3d29cc', '#36b9cc'];

new Chart(document.getElementById('timeLineChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            label: 'Total Stock',
            data: totalStock,
            borderColor: '#36b9cc',
            backgroundColor: 'rgba(54, 185, 204, 0.2)',
            borderWidth: 2,
            fill: true,
        }],
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});