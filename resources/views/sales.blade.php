<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/popup.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <?php
        use App\Models\Sale;
        $sales = Sale::all();
    ?>
</head>
<body>
    <script>

        function calcOpenPopup() {
            calcPopup.style.display = (calcPopup.style.display === 'block') ? 'none' : 'block';
        }

        function calcClosePopup(){
            calcPopup.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.detailView-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const sales = JSON.parse(button.getAttribute('data-id'));

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
                    // End of AJAX

                    document.getElementById('salesDetailPopup').style.display = 'flex';
                });
            });
        });

        function closeSalesPopupBtn() {
            $('#salesTable').html('');
            document.getElementById('salesDetailPopup').style.display = 'none'; // Hide the popup
        }

    </script>

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

    <div class="wrapper">
        <div class="sidebar">
            <ul>
                <li> <a href="\pos"> <button class= "listButton"> <i class="i fa fa-desktop"></i> POS </button> </a> </li>
                <li> <a href="\products"> <button class= "listButton" > <i class="i fa fa-shopping-basket"></i> Product </button> </a> </li>
                <li> <a href="\sales"> <button class= "listButton"> <i class="i fa fa-shopping-cart"></i> Sales </button> </a> </li>
            </ul>
        </div>

        <div class="mainviews" id="mainviews">

            {{-- <div class="mainpage"> --}}
                <div class="align">
                    <header>
                        <h1>Sales</h1>
                    </header>
                    {{-- <button class="addNewButton" id='addMember'><i class='fa fa-plus-square-o'></i> Add new member </button> --}}
                </div>

                <table class="table-sales">
                    <thead>
                    <tr>
                        <th class="th-sales">Reciept ID</th>
                        <th class="th-sales">Date</th>
                        <th class="th-sales">Total Quantity</th>
                        <th class="th-sales">Total Price</th>
                        <th class="th-sales">Payment Method</th>
                        <th class="th-sales" style="width: 10%"></th>
                        {{-- <th colspan='2'></th> --}}
                    </tr>
                    </thead>
                    <tbody>

                        @foreach ($sales as $sale)
                            <tr>
                                <td class="td-sales"> {{ sprintf("%010d", $sale->id) }} </td>
                                <td class="td-sales"> {{ $sale->created_at->toDateString() }} </td>
                                <td class="td-sales"> {{ $sale->totalQuantity }} </td>
                                <td class="td-sales"> {{ $sale->totalPrice }} </td>
                                <td class="td-sales"> {{ $sale->payMethod }} </td>
                                <td class="td-sales" style="padding: 0px; width: 60px;">
                                    <button class="detailView-btn" data-id="{{ $sale }}">
                                        {{-- <i style="width: 0px" class='fa fa-eye'></i>  --}}
                                        View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($errors->any())
                    <div class="alert alert-danger" style="color:red; padding-left: 20px;">
                        <div>
                            @foreach($errors->all() as $error)
                            <br> <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
            {{-- </div> --}}


            {{-------------- // EDIT // --------------}}


            <div id="salesDetailPopup" class="salesDetail">
                <div class="salesDetail-content" id="salesDetail-content">
                    <span class="close-btn" onclick="closeSalesPopupBtn()">&times;</span>
                    {{-- <div style="padding: 20px 0px">
                        <h3> Sales Detail </h3>
                    </div> --}}

                    <div id="salesTable">
                        {{-- Table is generated here --}}
                    </div>
                </div>
            </div>

        </div>
    </div>


    @if($errors->any())
        <div class="alert alert-danger" style="color:red; padding-left: 20px;">
            <div>
                @foreach($errors->all() as $error)
                <br> <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

</body>
</html>
