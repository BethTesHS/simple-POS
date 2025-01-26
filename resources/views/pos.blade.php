<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    @vite(['resources/css/all.css'])

    {{-- <script src="{{asset('js/categoryFilter.js')}}"> </script> --}}
    <script src="{{asset('js/popup.js')}}"> </script>
    <script src="{{asset('js/script.js')}}"> </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <?php
        use App\Models\Product;
        $products = Product::all();
    ?>
</head>
<body>

    <script>

        // Function to fetch products based on category
        function fetchProductsByCategory(categoryId) {
            var urlQuery = '';

            if (categoryId) {
                urlQuery = '{{ route("products.filter") }}';
            } else if (categoryId == 0) {
                urlQuery = '{{ route("products.all") }}';
            }

            $.ajax({
                url: urlQuery,
                method: 'GET',
                data: { category_id: categoryId },
                success: function (data) {
                    updateItemsView(data);
                },
            });
        }

        // Function to update items view dynamically
        function updateItemsView(data) {
            var html = '';

            if (data.length > 0) {
                data.forEach(function (product) {
                    html += `
                        <button onclick='addRow(${JSON.stringify(product)})' class="items" id="items-button" value="${product.id}">
                            <div class="items-pics"></div>
                            <text class="item-text"> ${product.productName} </text>
                        </button>
                    `;
                });
            } else {
                html = '<p>No Items.</p>';
            }

            $('#items-view').html(html);
        }

        // Function to initialize event listeners
        function initializeEventListeners() {
            $('.category').change(function () {
                var categoryId = $(this).val();
                fetchProductsByCategory(categoryId);
            });
        }

        // Document ready initialization
        $(document).ready(function () {
            initializeEventListeners();
        });
    </script>

    <div class="navbar">
        <h2>Simple POS</h2>
        <div style="display: flex; flex-direction: column;">
            <button id="calcDisplay" class="calc-btn" onclick="calcOpenPopup()">
                <i class="fa fa-calculator"></i>
            </button>
            <div id="calcPopup" >
                @include('popups/calc')
            </div>
        </div>
    </div>

    <div class="wrapper">
        <div class="left-view">
            <div class="control">
                <div class="search"> </div>
                <div class="date"> </div>
            </div>
            <div class="items-price">
                <table>
                    <thead>
                    <tr>
                        <th style="width:30%">Product</th>
                        <th>Quantity</th>
                        <th style="width:19%">Price</th>
                        <th>Subtotal</th>
                        <th style="width:11%"></th>
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
                        <th class="total-items"> Items: 0</th>
                        <th class="total-amount"> Total: 0.00 ksh </th>
                    </tr>
                </table>
            </div>
            <div class="payment">
                <select class="pay-method">
                    <option> -- Payment Method -- </option>
                    <option> ... </option>
                    <option> ... </option>
                    <option> ... </option>
                </select>
                <div class="pay">
                    <button class="cancel-pay"> Cancel Payment </button>
                    <button class="complete-pay"> Complete Payment </button>
                </div>
            </div>
        </div>

        <div class="right-view">
            <div class="control2">
                <select id="category" name="category_id" class="dropdown category" >
                    <option value="0">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <button id='popupButton' class="popupButton" onclick="addProduct()">
                    <text class='i'>
                        <i class='fa fa-plus-square-o'></i>
                    </text>
                    Add new product
                </button>
            </div>

            <div class="items-view" id="items-view">
                {{-- JS CONNECTED HERE --}}
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
    </div>

    {{-- -----------  POP UPS ----------- --}}
    <div id="popupMessage" class="productPopup">
        @include('popups.addProduct')
    </div>

    <div id="popupMessage2" class="productPopup">
        @include('popups.addCategory')
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
