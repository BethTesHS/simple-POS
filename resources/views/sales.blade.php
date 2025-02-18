<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple POS</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/salesPages.js'])
    @vite(['resources/js/sales.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    
</head>
<body>
    <script>  
        //  Popup reciept and loads data
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.detailView-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const sales = JSON.parse(button.getAttribute('data-id'));

                    // Load data via AJAX
                    $.ajax({
                        url: '{{ route("salesDetail") }}',
                        method: 'GET',
                        data: { sale_id: sales['id'] },
                        success: function (data) {
                            var html = '';
                            var table = '';
                            if (data.length > 0) {
                                data.forEach(function (salesDetail) {
                                    table += `
                                        <tr>
                                            <td class="thd" style="width: 50%"> ${salesDetail.productName} </td>
                                            <td class="thd"> ${salesDetail.price} ksh</td>
                                            <td class="thd"> ${salesDetail.quantity} </td>
                                            <td class="thd"> ${((salesDetail.quantity)*(salesDetail.price)).toFixed(2)} ksh</td>
                                        </tr>
                                    `;
                                });
                            } else {
                                html = '<p>No Items.</p>';
                            }

                            const receiptNumber = String(sales['id']).padStart(10, '0');

                            const date = sales['created_at'].split('T')[0];
                            const time = sales['created_at'].split('T')[1].split(':').slice(0, 2).join(':');

                            html = `    <div id="salesTable">
                                        <text style="margin-bottom: 50px"><b>Receipt Number:</b> ${receiptNumber} </text>
                                        <br>
                                        <text style="margin-bottom: 50px"><b>Payment Method:</b> ${sales['payMethod']} </text>
                                        <br>
                                        <text style="margin-bottom: 50px"><b>Date:</b> ${date} </text>
                                        <br>
                                        <text style="margin-bottom: 50px"><b>Time:</b> ${time} </text>
                                        <table class="table salesDetailTable">
                                            <thead>
                                                <tr>
                                                    <th class="thd">Product</th>
                                                    <th class="thd">Price</th>
                                                    <th class="thd">Quantity</th>
                                                    <th class="thd">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${table}
                                            </tbody>
                                            <thead>
                                                <th class="thd" colspan='2'>Total</th>
                                                <th class="thd">${sales['totalQuantity']}</th>
                                                <th class="thd">${sales['totalPrice']} ksh</th>
                                            </thead>
                                        </table>
                                        </div>
                                    `;
                            $('#salesTable').html(html);
                        },
                    });

                    // Show popup
                    document.getElementById('salesDetailPopup').style.display = 'flex';
                });
            });
        });

        // Close popup and remove loaded data
        function closeSalesPopupBtn() {
            $('#salesTable').html('');
            document.getElementById('salesDetailPopup').style.display = 'none'; // Hide the popup
        }
    </script>

    {{-- -----------  NAVIGATION BAR ----------- --}}
    <div class="navbar">
        <a href="\pos"><h2>Simple POS</h2></a>
        <div style="display: flex; flex-direction: row;">
            <button id="calcDisplay" class="calc-btn" onclick="calcOpenPopup()">
                <i class="fa fa-calculator"></i>
            </button>
            <div id="calcPopup" >
                @include('calc')
            </div>
        </div>
    </div>

    {{-- ----------- SCREEN ----------- --}}
    <div class="wrapper">
        {{-- -----------  SIDE BAR ----------- --}}
        <div class="sidebar">
            <ul>
                <li> <a href="{{ route('pos') }}"> <button class= "listButton"> <i class="i fa fa-desktop"></i> POS </button> </a> </li>
                <li> <a href="{{ route('products') }}"> <button class= "listButton" > <i class="i fa fa-shopping-basket"></i> Product </button> </a> </li>
                <li> <a href="{{ route('sales') }}"> <button style="color: white" class= "listButton"> <i class="i fa fa-shopping-cart"></i> Sales </button> </a> </li>
                <li> <a href="{{ route('stocks') }}"> <button class= "listButton"> <i class="i fa fa-line-chart"></i> Stocks </button> </a> </li>
                <hr style="border: 0.5px solid rgb(167, 124, 67); width: 90%; margin: 10px;">
                <li> <form action="{{ route('logout') }}" method="POST"> @csrf <button class= "listButton" type="submit"> <i class="i fa fa-sign-out"></i> Logout </button> </form> </li>
            </ul>
        </div>

        {{-- -----------  MAIN VIEW ----------- --}}    
        <div class="mainviews" id="mainviews">
            <div class="mainpage">
                <div class="align">
                    <header>
                        <h1>Sales</h1>
                    </header>

                    
                    <div style="padding-bottom: 5px; display:flex; flex-direction: row">
                        <text class="i dateButton" >
                            <i class='fa fa-calendar'></i>
                            <input readonly type="button" id="filterDate" value="All Dates">
                        </text>
                    </div>
                </div>

                <div class="tableContainer">
                    <table class="table-sp">
                        <thead>
                            <tr>
                                <th class="th-sp">Reciept ID</th>
                                <th class="th-sp">Date</th>
                                <th class="th-sp">Total Quantity</th>
                                <th class="th-sp">Total Price</th>
                                <th class="th-sp">Payment Method</th>
                                <th class="th-sp" style="width: 10%"></th>
                                {{-- <th colspan='2'></th> --}}
                            </tr>
                        </thead>
                        <tbody id="salesTableBody">
                            @foreach ($sales as $sale)
                                <tr class="row" data-date="{{ $sale->created_at->toDateString() }}">
                                    <td class="td-sp"> {{ sprintf("%010d", $sale->id) }} </td>
                                    <td class="td-sp"> {{ $sale->created_at->toDateString() }} </td>
                                    <td class="td-sp"> {{ $sale->totalQuantity }} </td>
                                    <td class="td-sp"> {{ $sale->totalPrice }} ksh</td>
                                    <td class="td-sp"> {{ $sale->payMethod }} </td>
                                    <td class="td-sp" style="padding: 0px; width: 60px;">
                                        <button class="detailView-btn" data-id="{{ $sale }}">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <button id="prevPage"> ‹ </button>
                        <div class="inputChange">
                            <span id="pageIndicator">Page</span>
                            {{-- <input autocomplete="off" type="text" inputmode=”numeric” id="pageInput" value="1" />
                            <span id="maxPage"> of </span> --}}
                        </div>
                    <button id="nextPage"> › </button>
                </div>
            </div>
        </div>
    </div>


    {{-------------- // POPUPS // --------------}}

    {{-- Receipt Popup --}}
    <div id="salesDetailPopup" class="salesDetail">
        <div class="salesDetail-content" id="salesDetail-content">
            <span class="close-btn" onclick="closeSalesPopupBtn()">&times;</span>
            <div id="salesTable">
                {{-- Table is generated here --}}
            </div>
        </div>
    </div>

    {{-- -----------  ALERTS ----------- --}}
    @if(session('error_alert') && $errors->any())
        <script>
            window.onload = function() {
                let errorMessage = "";
                @foreach($errors->all() as $error)
                    errorMessage += "{{ $error }}\n";
                @endforeach
                alert(errorMessage);
            };
        </script>
    @endif

</body>
</html>
