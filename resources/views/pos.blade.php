<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple POS</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/pos.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>
<body>

    <script>
    // The function that lets us filter by category and/or search
        $(document).ready(function () {
            $('.query, .category').change(function () {
                $.ajax({
                    url: '{{ route("products.search") }}',
                    method: 'GET',
                    data: {
                        search_query: $('.query').val(),
                        category_id: $('.category').val()
                    },
                    success: function (data) {
                        var html = '';
                        if (data.length > 0) {
                            data.forEach(function (product) {
                                html += `
                                    <button type="button" onclick='addRow(${JSON.stringify(product)})' class="items" id="items-button" value="${product.id}">
                                        <div class="items-pics"><img class="image" src="{{asset('default.png')}}"></div>
                                        <text class="item-text"> ${product.productName} </text>
                                    </button>
                                `;
                            });
                        } else {
                            html = '<p>No Items.</p>';
                        }
                        $('#items-view').html(html);
                    },
                });
            });
        });
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
                <li> <a href="{{ route('pos') }}"> <button style="color: white" class= "listButton"> <i class="i fa fa-desktop"></i> POS </button> </a> </li>
                <li> <a href="{{ route('products') }}"> <button class= "listButton" > <i class="i fa fa-shopping-basket"></i> Product </button> </a> </li>
                <li> <a href="{{ route('sales') }}"> <button class= "listButton"> <i class="i fa fa-shopping-cart"></i> Sales </button> </a> </li>
            </ul>
        </div>

        {{-- -----------  MAIN VIEW ----------- --}}
        <div class="main-pos">
            <div class="right-view">
                <div class="control2">
                    <div class="search">
                        <i class='fa fa-search'></i>
                        <input autocomplete="off" class="query" type="text" name="search_query" value="" placeholder="Search for an item...">
                    </div>
                    <select id="category" name="category_id" class="dropdown category" >
                        <option value="0">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="items-view" id="items-view">
                    {{-- items will be generated here --}}
                    @if ($products == null)
                        <text> No Item </text>
                    @else
                        @foreach($products as $product)
                            <button onclick="addRow({{$product}})" class="items" id="items-button" value="{{$product->id}}">
                                <div class="items-pics"><img class="image" src="{{asset('default.png')}}"></div>
                                <text class="item-text"> {{ $product->productName }} </text>
                            </button>
                        @endforeach
                    @endif

                </div>
            </div>

            <form action="{{ route('sales.storeSale') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="left-view">
                <div class="control">
                    <div class="date">
                        <?php echo date("F j, Y"); ?>
                    </div>
                </div>
                <div class="items-price">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="thd" style="width:25%">Product</th>
                                <th class="thd" style="width:10%">Quantity</th>
                                <th class="thd" style="width:20%">Price</th>
                                <th class="thd" style="width:25%">Subtotal</th>
                                <th class="thd"></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            {{-- Rows will be formed here --}}
                        </tbody>
                    </table>
                </div>

                    <div class="total-price">
                        <table>
                            <tr>
                                <th class="total-items"><input type="hidden" id="totalQuantity" name="totalQuantity" value="0"> Items: 0</th>
                                <th class="total-amount"><input type="hidden" id="totalPrice" name="totalPrice" value="0"> Total: 0.00 ksh </th>
                            </tr>
                        </table>
                    </div>
                    <div class="payment">
                        <select id="payMethod" name="payMethod" class="pay-method">
                            <option value=""> -- Payment Method -- </option>
                            <option value="Cash"> Cash </option>
                            <option value="Debit or Credit"> Debit or Credit </option>
                            <option value="M-PESA"> M-PESA </option>
                            <option value="Others"> Others </option>
                        </select>
                        <div class="pay">
                            <button type="button" class="cancel-pay" onclick="cancelPayment()"> Cancel </button>
                            <button type="submit" class="complete-pay"> Complete Payment </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    {{-- -----------  POP UPS ----------- --}}

    {{-- Receipt Popup --}}
    <div id="popupReceipt" class="salesDetail">
        <div class="salesDetail-content" id="salesDetail-content">
            <span class="close-btn" onclick="closeReceiptPopupBtn()">&times;</span>
            <h3>Payment Complete!</h3>
            <br>
            @if ($sale == null)
                <div>
                    <h4>No Data</h4>
                    <p>There is nothing to show</p>
                </div>
            @else
            <div id="salesTable">
                <text style="margin-bottom: 50px"><b> Receipt Number: </b> {{sprintf("%010d",$sale->id)}} </text>
                <br>
                <text style="margin-bottom: 50px"><b>Payment Method:</b> {{$sale->payMethod}} </text>
                <br>
                <text style="margin-bottom: 50px"><b> Date: </b> {{date('Y-m-d', strtotime($sale->created_at))}} </text>
                <br>
                <text style="margin-bottom: 50px"><b> Time: </b> {{date('H:i:s', strtotime($sale->created_at))}} </text>
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
                        @foreach($saleDetails as $saleDetail)
                            <tr>
                                <td class="thd" style="width: 50%"> {{$saleDetail->productName}} </td>
                                <td class="thd"> {{$saleDetail->price}} ksh</td>
                                <td class="thd"> {{$saleDetail->quantity}} </td>
                                <td class="thd"> {{number_format(($saleDetail->quantity)*($saleDetail->price), 2)}} ksh</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <th class="thd" colspan='2'>Total</th>
                        <th class="thd">{{$sale->totalQuantity}}</th>
                        <th class="thd">{{$sale->totalPrice}} ksh</th>
                    </thead>
                </table>
            </div>
            @endif
        </div>
    </div>

    {{-- -----------  ALERTS ----------- --}}
    @if (session('success'))
        <script>
            // openReceiptPopupBtn();
            document.getElementById('popupReceipt').style.display = 'flex';
        </script>
    @endif
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