<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    @vite(['resources/css/style.css'])
    @vite(['resources/css/popup.css'])

    @vite(['resources/js/popup.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <?php
        use App\Models\Product;
        use Illuminate\Http\Request;
    ?>
</head>
<body>

    
    
    
    <div id="categoryListID">
        <?php $products = Product::all(); ?>
        {{-- <text>$products</text> --}}
    </div>
    
    <?php $items = [];
        foreach ($products as $product){
            $items[] = "$product->productName";
        }
    ?>

    <script>
        $(document).ready(function () {
            $('#category').change(function () {
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
                                html += `<div class="items">
                                            <div class="items-pics"></div>
                                            <text class="item-text">` + product.productName + `</text>
                                        </div>`;
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
        <h2>Dashboard</h2>
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
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price inc. tax</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Hello </td>
                            <td> Hello </td>
                            <td> Hello </td>
                            <td> Hello </td>
                            
                            <td style="padding: 3px; width: 60px;">
                                <button class="deleteMember">
                                    <i style="width: 0px" class='fa fa-trash-o'></i> Remove
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td> Goodbye </td>
                            <td> Goodbye </td>
                            <td> Goodbye </td>
                            <td> Goodbye </td>
                            
                            
                            <td style="padding: 3px; width: 60px;">
                                <button class="deleteMember">
                                    <i style="width: 0px" class='fa fa-trash-o'></i> Remove
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div class="total-price"> </div>
            <div class="payment"> </div>
        </div>

        
        <div class="right-view">
            <div style="display: flex; flex-direction: row;">

                <button id='popupButton2' style="text-align:center">
                    <i class='fa fa-plus-square-o'></i>
                </button>
                <select id="category" name="category_id" class="dropdown" >
                    <option value="0">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <button id='popupButton'>
                    <i class='fa fa-plus-square-o'></i> 
                    Add new product 
                </button>  
            </div>

            <div class="items-view" id="items-view">
                {{-- JS CONNECTED HERE --}}
                @if ($items == null)
                    <text> No Item </text>
                @else
                    @foreach($items as $item)
                        <div class="items" id="items"> 
                            <div class="items-pics"></div>
                            <text class="item-text"> {{ $item }} </text>
                        </div>
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
                <input class="textArea" name="price" type="number" maxlength="10"> <br>

                <label> Category </label> <br>
                <select id="category" name="category_id" class="dropdown" >
                    <option value="">--Select Category--</option>
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
