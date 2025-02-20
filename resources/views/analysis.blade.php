<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>

    <title>Simple POS</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/pos.js'])
    @vite(['resources/css/chart.css'])
    {{-- @vite(['resources/css/addMembersPopup.css']) --}}


    @vite(['resources/js/script.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>

<body>

    <div class="navbar">
        <h2>Dashboard</h2>
    </div>

    <div class="wrapper">
        <div class="mainpage">
            <header>
                <h1>Analysis</h1>
                <p>
                    {{$stockDates}}
                    {{$stocksPerDate}}
                </p>
            </header>

            <br>
            
            @if ($stockDates->isEmpty())
                <div>
                    <h4>No Data</h4>
                    <p>There is nothing to show</p>
                </div>
            @else
                <div>
                    <h4>Visual Representation of Hours Spent</h4>
                    <p>The charts visualizes the data of the time that was contributed to the establishment.</p>
                </div>

                <hr style="margin: 20px 10px"/>

                
                <div class="chart-wrapper">
                    <div class="chart-container" style="width: 400px; padding-top:70px;">
                        <canvas id="timeLineChart"></canvas>
                    </div>
                    <br>
                </div>
            @endif
        </div>
    </div>


    {{-- ------------------------------ --}}
    

    <script>
        
        const dates = <?php echo json_encode($stockDates); ?>;
        const totalStock = <?php echo json_encode($stocksPerDate); ?>;
       
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
    </script>

</body>
</html>
