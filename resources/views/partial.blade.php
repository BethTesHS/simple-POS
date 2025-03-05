<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple POS</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/salesPages.js'])
    @vite(['resources/js/productsPages.js'])
    @vite(['resources/js/partialPopup.js'])
    {{-- @vite(['resources/js/sales.js']) --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


</head>
<body>
    

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
                <li> <a href="{{ route('stocks') }}"> <button class= "listButton"> <i class="i fa fa-line-chart"></i> Stocks </button> </a> </li>
                <hr style="border: 0.5px solid #4372a7; width: 90%; margin: 10px;">

                <li> <a href="{{ route('sales') }}"> <button class= "listButton"> <i class="i fa fa-shopping-cart"></i> Sales </button> </a> </li>
                <li> <a href="{{ route('partial') }}"> <button style="color: white" class= "listButton"> <i class="i fa fa-money"></i> Partial <br>Payments </button> </a> </li>
                <hr style="border: 0.5px solid #4372a7; width: 90%; margin: 10px;">

                <li> <a href="{{ route('users') }}"> <button class= "listButton"> <i class="i fa fa-user"></i> Users </button> </a> </li>
                <li> <a href="{{ route('customers') }}"> <button class= "listButton" > <i class="i fa fa-users"></i> Customers </button> </a> </li>
                <hr style="border: 0.5px solid #4372a7; width: 90%; margin: 10px;">
                <li> <form action="{{ route('logout') }}" method="POST"> @csrf <button class= "listButton" type="submit"> <i class="i fa fa-sign-out"></i> Logout </button> </form> </li>
            </ul>
        </div>

        {{-- -----------  MAIN VIEW ----------- --}}
        <div class="mainviews" id="mainviews">
            <div class="mainpage">
                <div class="align">
                    <header>
                        <h1>Partial Payments</h1>
                    </header>

                    <select style="margin-bottom: 5px; border-radius: 10px;" name="category_id" class="dropdown3 categoryFilter" id="categoryFilter">
                        <option value="0">All Customers</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->firstName }}">{{ $customer->firstName ." ". $customer->lastName}}</option>
                        @endforeach
                    </select>

                    {{-- 
                    <div style="padding-bottom: 5px; display:flex; flex-direction: row">
                        <text class="i dateButton" >
                            <i class='fa fa-calendar'></i>
                            <input readonly type="button" id="filterDate" value="All Dates">
                        </text>
                    </div> 
                    --}}
                    
                </div>

                <div class="tableContainer">
                    <table class="table-sp">
                        <thead>
                            <tr>
                                <th class="th-sp">Partial ID</th>
                                <th class="th-sp">Reciept ID</th>
                                <th class="th-sp">Customer Name</th>
                                <th class="th-sp">Date</th>
                                <th class="th-sp">Amount Paid</th>
                                <th class="th-sp">Amount to pay</th>
                                <th class="th-sp">Total Price</th>
                                <th class="th-sp" style="width: 10%"></th>
                                {{-- <th colspan='2'></th> --}}
                            </tr>
                        </thead>
                        <tbody id="salesTableBody">
                            @foreach ($partial as $part)
                                <tr class="row" data-date="{{ $part->created_at->toDateString() }}" category-category="{{$part->customer->firstName }}">
                                    <td class="td-sp"> {{ sprintf("%06d", $part->id) }} </td>
                                    <td class="td-sp"> {{ sprintf("%010d", $part->sale->id) }} </td>
                                    <td class="td-sp"> {{ $part->customer->firstName ." ". $part->customer->lastName }} </td>
                                    <td class="td-sp"> {{ $part->created_at->toDateString() }} </td>
                                    <td class="td-sp"> {{ $part->paid }} ksh</td>
                                    <td class="td-sp"> {{ $part->toPay }} ksh</td>
                                    <td class="td-sp"> {{ $part->total }} ksh</td>
                                    <td class="td-sp" style="padding: 10px;">
                                        @if ($part->toPay == 0)
                                            {{-- <i class="i fa fa-money"></i>  --}}
                                            <p style="color: #0000009f;">
                                                Complete
                                            </p>    
                                        @elseif ($part->latest == 1)
                                        <button class="detailView-btn" data-id="{{ $part }}" style="flex-direction: row">
                                            {{-- <i class="i fa fa-money"></i>   --}}
                                            Pay Now
                                        </button>
                                        @else
                                            <p style="color: #0000009f;">
                                                Outdated Statement
                                            </p>
                                        @endif
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

    {{-- TODO: Popup for Patial --}}
    <div id="popupPayment" class="productPopup">
        <div class="productPopup-content">

            <span class="close-btn" onClick="closePopup()">&times;</span>
            <div style="padding: 20px 0px">
                <h2> Payment Plan </h2>
            </div>

            <form id="paymentForm" action="{{ route('partial.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <input id="pid" name="partial_id" value="" hidden>
                <input id="sid" name="sale_id" value="" hidden>
                <input id="cid" name="customer_id" value="" hidden>

                <label> Total Price </label> <br>
                <input id="totPrice" class="textArea" name="totalPay" type="text" value="????" readonly> <br>

                <label> Total Paid </label> <br>
                <input id="totPaid" class="textArea" name="totPaid" type="text" value="????" readonly> <br>

                <label> To Pay </label> <br>
                <input id="toPay" class="textArea" name="toPay" type="text" value="????" readonly> <br>

                <label> Amount to pay now </label> <br>
                <input id="payNow" class="textArea" name="payNow" type="number"  oninput="check()"> <br>

                <button type="submit" class="textButton" id="completePartialButton"> Complete Payment </button>
            </form>
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
