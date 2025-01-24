<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    @vite(['resources/css/style.css'])
    @vite(['resources/css/popup.css'])
    @vite(['resources/css/table.css'])

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
        function add(price, id) {
            let currentValue = parseInt(ids.value);
            ids.value = currentValue + 1;
            // subTot = "sub"+${product['id']};
            subTot.value = (price * (currentValue + 1)).toFixed(2);
        }

        function sub(price, id) {
            let currentValue = parseInt(ids.value)
            if(currentValue>1){
                ids.value = currentValue - 1;
                // subTot = "sub"+${product['id']};
                subTot.value = (price * (currentValue - 1)).toFixed(2);
            }
        }
        
        let count = 0;
        function addRow(productDetail) {
            count++;
            const table  = document.getElementById('tableBody');
            const newRow = document.createElement('tr');

            product = productDetail;

            newRow.innerHTML = `<td>`+ product['productName'] +`</td>
                                <td class="quantity">
                                    <button onclick="sub(${product['price']}, ${product['id']})" class="button"> - </button>
                                    <input type="text" class="display" id="ids" value="1" readonly>
                                    <button onclick="add(${product['price']}, ${product['id']})" class="button"> + </button>
                                </td>
                                <td>`+ product['price'] +` ksh</td>
                                <td><input id="subTot" class="subTotal" value="`+product['price']+`"> ksh</td>
                                <td>
                                    <button class="removeButton" onclick="removeRow(this)">
                                        <i style="padding: 0 10px" class="fa fa-trash-o"></i> Remove
                                    </button>
                                </td>`;

            table.appendChild(newRow);
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
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
                                html += `<button onclick='addRow(`+JSON.stringify(product)+`)' class="items" id="items-button" value="` + product.id + `"> 
                                            <div class="items-pics"></div>
                                            <text class="item-text">` + product.productName + `</text>
                                        </button>`;
                                            
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
        <h2>Simple POS</h2>
        <button class="click" onclick="addRow()">CLICK HERE</button>
    </div>

    <div class="wrapper">
        
        <div class="left-view">
            <div class="control">
                {{-- <div class="search"> </div>
                <div class="date"> </div> --}}
            </div>
            <div class="items-price"> 
                <table>
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th></th>
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
                        <th> Items: 3</th>
                        <th> Total: 1300 ksh </th>
                    </tr>
                </table>
            </div>
            <div class="payment"> </div>
        </div>

        
        <div class="right-view">
            <div class="control2">
                <button id='popupButton2' class="popupButton2">
                    <text class='i'>
                        <i class='fa fa-plus-square-o'></i>
                    </text>
                </button>
                <select id="category" name="category_id" class="dropdown category" >
                    <option value="0">All</option>
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
                            <div class="items-pics"></div>
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
                <select id="category" name="category_id" class="dropdown2" >
                    <option value=""> -- Select Category -- </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    {{-- <option><button>-- Add New Category --</button></option> --}}
                </select> <br>

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

                <input class="textButton" name="addCatgory" type="submit" value="Add Category"> <br>
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
