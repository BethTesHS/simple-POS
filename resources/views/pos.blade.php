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
        use App\Models\Product;
        $products = Product::all();
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

        function updateTotals() {
            let totalQuantity = 0;
            let totalAmount = 0;

            document.querySelectorAll('#tableBody tr').forEach(row => {
                const quantity = parseInt(row.querySelector('.quantity input').value);
                const subtotal = parseFloat(row.querySelector('.subTotal').value);

                totalQuantity += quantity;
                totalAmount += subtotal;
            });

            document.querySelector('.total-items').innerHTML = `<input type="hidden" name="totalQuantity" value="${totalQuantity}"> Items: ${totalQuantity}`;
            document.querySelector('.total-amount').innerHTML = `<input type="hidden" name="totalPrice" value="${totalAmount.toFixed(2)}"> Total: ${totalAmount.toFixed(2)} ksh`;
        }

        function add(price, ids) {
            let currentValue = parseInt(ids.value);
            ids.value = currentValue + 1;
            let subTot = ids.closest('tr').querySelector('.subTotal');
            subTot.value = (price * (currentValue + 1)).toFixed(2);
            updateTotals();
        }
        function sub(price, ids) {
            let currentValue = parseInt(ids.value)
            if(currentValue > 1) {
                ids.value = currentValue - 1;
                let subTot = ids.closest('tr').querySelector('.subTotal');
                subTot.value = (price * (currentValue - 1)).toFixed(2);
                updateTotals();
            }
        }
        function change(price, ids){
            let currentValue = parseInt(ids.value)
            if(currentValue < 1 || !currentValue){
                currentValue = 1;
            }
            ids.value = currentValue
            let subTot = ids.closest('tr').querySelector('.subTotal');
            subTot.value = (price * currentValue).toFixed(2);
            updateTotals();
        }

        function addRow(productDetail) {
            const table = document.getElementById('tableBody');

            // Check if the product already exists in the table
            const existingRow = Array.from(table.children).find(row => row.dataset.productId == productDetail.id);
            if (!existingRow) {
                // alert('This product is already in the table.');
                // return;

            const newRow = document.createElement('tr');
            newRow.dataset.productId = productDetail.id; // Add a custom attribute to track the product ID

            newRow.innerHTML = `
                <td class="product"> 
                    ${productDetail['productName']} 
                    <input type="hidden" name="products[${productDetail['id']}][productName]" value="${productDetail['productName']}">
                </td>

                <td class="quantity">
                    <button type="button" onclick="sub(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" class="button"> - </button>
                    <input oninput="change(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" type="text" class="display" value="1" name="products[${productDetail['id']}][quantity]">
                    <button type="button" onclick="add(${productDetail['price']}, this.closest('tr').querySelector('.quantity input'))" class="button"> + </button>
                </td>

                <td class="price"> 
                    ${productDetail['price']} ksh
                    <input type="hidden" name="products[${productDetail['id']}][price]" value="${productDetail['price']}">
                </td>

                <td>
                    <input id="subTot" class="subTotal" value="${productDetail['price']}" readonly name="products[${productDetail['id']}][subtotal]"> ksh
                </td>

                <td style="width:20px">
                    <button class="removeButton" onclick="removeRow(this)">
                        <i style="padding: 0 10px" class="fa fa-trash-o"></i> Remove
                    </button>
                </td>`;
                table.appendChild(newRow);
                updateTotals();
            }
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
            updateTotals();
        }

        function cancelPayment() {
        // Clear all rows in the table
        const table = document.getElementById('tableBody');
        table.innerHTML = ''; // Remove all rows

        // Reset totals
        document.querySelector('.total-items').innerHTML = `<input type="hidden" name="totalQuantity" value="0"> Items: 0`;
        document.querySelector('.total-amount').innerHTML = `<input type="hidden" name="totalPrice" value="0"> Total: 0.00 ksh`;
    }

        $(document).ready(function () {
            $('.category').change(function () {
                var categoryId = $(this).val();
                var url_query = '';
                if (categoryId) {
                    url_query = '{{ route("products.filter") }}';
                } else if (categoryId == 0){
                    url_query = '{{ route("products.all") }}';
                }
                $.ajax({
                    url: url_query,
                    method: 'GET',
                    data: { category_id: categoryId },
                    success: function (data) {
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
                    },
                });
            });
        });

    </script>

    <div class="navbar">
        <a href="\pos"><h2>Simple POS</h2></a>
        <div style="display: flex; flex-direction: row;">
            {{-- <button id="sales-btn" class="sales-btn">
                Sales
            </button> --}}
            <a href="\sales" id="sales-btn" class="sales-btn">
                Sales
            </a>
            <a href="\products" id="sales-btn" class="sales-btn">
                Products
            </a>
            <button id="calcDisplay" class="calc-btn" onclick="calcOpenPopup()">
                <i class="fa fa-calculator"></i>
            </button>
            <div id="calcPopup" >
                @include('calc')
            </div>
        </div>
    </div>



    <div class="wrapper">
        <form action="{{ route('sales.storeSale') }}" method="POST">
            @csrf
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
                            <th class="total-items"><input type="hidden" name="totalQuantity" value="0"> Items: 0</th>
                            <th class="total-amount"><input type="hidden" name="totalPrice" value="0"> Total: 0.00 ksh </th>
                        </tr>
                    </table>
                </div>
                <div class="payment">
                    <select name="payMethod" class="pay-method">
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

        <div class="right-view">
            <div class="control2">
                <select id="category" name="category_id" class="dropdown category" >
                    <option value="0">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <button id='popupButton' class="popupButton">
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
        <div class="productPopup-content">

            <span class="close-btn" id="closePopup">&times;</span>
            <div style="padding: 20px 0px">
                <h2> Add New Product </h2>
            </div>

            <form action="{{ route('products.store') }}" autocomplete="off" method="POST">
                @csrf

                <label> Product Name</label> <br>
                <input class="textArea" name="productName" type="text"> <br>

                <label> Price </label> <br>
                <input class="textArea" name="price" type="number" step="any" maxlength="10"> <br>

                <label> Category </label> <br>

                {{-- CATEGORY BUTTON --}}
                <div class="categoryPopup">
                    <button id='popupButton2' class="popupButton2" type="button">
                        <text class='i'>
                            <i class='fa fa-plus-square-o'></i>
                        </text>
                    </button>

                    <select id="category" name="category_id" class="dropdown2" >
                        <option value=""> -- Select Category -- </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select> <br>
                </div>



                <input class="textButton" name="addProduct" type="submit" value="Add Product"> <br>
            </form>

        </div>
    </div>

    <div id="popupMessage2" class="productPopup">
        <div class="productPopup-content">

            <span class="close-btn" id="closePopup2">&times;</span>
            <div style="padding: 20px 0px">
                <h2> Create Category </h2>
            </div>

            <form action="{{ route('categories.store') }}" autocomplete="off" method="POST">
                @csrf

                <label> Category Name </label> <br>
                <input class="textArea" name="name" type="text"> <br>

                <input id="createCategory" class="textButton" name="addCatgory" type="submit" value="Add Category"> <br>
            </form>

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
