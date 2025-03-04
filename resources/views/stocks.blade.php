<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple POS</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/productsPopup.js'])
    @vite(['resources/js/salesPages.js'])
    @vite(['resources/js/sales.js'])
    @vite(['resources/js/chart.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <script>

        const dates = <?php echo json_encode($stockDates) ?>;
        const totalStock = <?php echo json_encode($stocksPerDate) ?>;

    </script>

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
                <li> <a href="{{ route('stocks') }}"> <button  style="color: white" class= "listButton"> <i class="i fa fa-line-chart"></i> Stocks </button> </a> </li>
                <hr style="border: 0.5px solid #4372a7; width: 90%; margin: 10px;">

                <li> <a href="{{ route('sales') }}"> <button class= "listButton"> <i class="i fa fa-shopping-cart"></i> Sales </button> </a> </li>
                <li> <a href="{{ route('partial') }}"> <button class= "listButton"> <i class="i fa fa-money"></i> Partial <br>Payments </button> </a> </li>
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
                        <h1>Stocks</h1>
                    </header>

                    <div style="padding-bottom: 5px; display:flex; flex-direction: row">
                        @if (auth()->user()->role == "Buyer" || auth()->user()->role == "Buyer/Seller")
                            <button id='popupButton' class="addNewButton">
                                <text class='i'>
                                    <i class='fa fa-plus-square-o'></i>
                                </text>
                                Purchase Product
                            </button>

                        @else
                            <button id='unPopupButton' class="addNewButton" style="background-color: gray;">
                                <text class='i'>
                                    <i class='fa fa-plus-square-o'></i>
                                </text>
                                Purchase Product
                            </button>
                        @endif

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
                                <th class="th-sp">Date</th>
                                {{-- <th class="th-sp">Product ID</th> --}}
                                <th class="th-sp">Product Name</th>
                                <th class="th-sp">Stock Change</th>
                                <th class="th-sp">Total Stock</th>
                                <th class="th-sp">Sales Type</th>
                                <th class="th-sp">Done By</th>
                                {{-- <th class="th-sp" style="width: 10%"></th> --}}
                                {{-- <th colspan='2'></th> --}}
                            </tr>
                        </thead>
                        <tbody id="salesTableBody">
                            @foreach ($stocks as $stock)
                                <tr class="row" data-date="{{ $stock->created_at->toDateString() }}">
                                    <td class="td-sp"> {{ $stock->created_at->toDateString() }} </td>
                                    {{-- <td class="td-sp"> {{ sprintf("%010d", $stock->product_id) }} </td> --}}
                                    <td class="td-sp"> {{ $stock->productName }} </td>
                                    <td class="td-sp"> {{ $stock->quantity }} </td>
                                    <td class="td-sp"> {{ $stock->totalQuantity }}  </td>
                                    <td class="td-sp"> {{ $stock->purchaseType }}  </td>
                                    <td class="td-sp"> {{ $stock->user->firstName }}  </td>
                                    {{-- <td class="td-sp"> {{ $products->where('id', $stock->product_id)->first()->stockQuantity }} </td> --}}

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

                @if ($stockDates->isEmpty())
                    <div>
                        {{-- <h4>No Data</h4>
                        <p>There is nothing to show</p> --}}
                    </div>
                @else
                    <div class="chart-wrapper">
                        <div class="chart-container" style="width: 400px; padding-top:70px;">
                            <canvas id="timeLineChart"></canvas>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-------------- // POPUPS // --------------}}

    {{-- Add Product Popup --}}
    <div id="popupMessage" class="productPopup">
        <div class="productPopup-content">

            <span class="close-btn" id="closePopup">&times;</span>
            <div style="padding: 20px 0px">
                <h2> Stock Up </h2>
            </div>

            <form action="{{ route('stocks.update') }}" autocomplete="off" method="POST">
                @csrf

                <label> Product Name </label> <br>

                <div class="categoryPopup">

                    <select id="product" name="product" class="dropdown2" >
                        <option value=""> -- Select Category -- </option>
                        @foreach($products as $product)
                            <option value="{{ json_encode([$product->id, $product->productName]) }} ">
                                {{ $product->productName }}
                                {{-- <input name="productName" value="{{ $product->productName }}" type="hidden"> --}}
                            </option>
                        @endforeach
                    </select> <br>
                </div>

                <label> Buying Price per Item</label> <br>
                <input class="textArea" name="buyingPrice" type="number" value="" placeholder="" step="any" maxlength="10"> <br>
                

                <label> Quantity </label>
                <input class="textArea" name="buyingPrice" type="number" value="" placeholder="" step="any" maxlength="10"> <br>
                <div class="stock">
                    <button type="button" onclick="sub(this.closest('div').querySelector('.stock input'))" class="button"> - </button>
                        <input class="display" id="sq" name="quantity" oninput="change(this.closest('div').querySelector('.stock input'))" type="text" value="0">
                    <button type="button" onclick="add(this.closest('div').querySelector('.stock input'))" class="button"> + </button>
                </div>

                <input class="textButton" name="addProduct" type="submit" value="Add Product"> <br>
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
