<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    @vite(['resources/css/style.css'])
    @vite(['resources/css/popup.css'])

    @vite(['resources/js/popup.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>
<body>
    


    <?php
    use App\Models\Product;
    $products = Product::all();
    ?>

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

        
        @foreach ($products as $product)
            <?php $items[] = "$product->productName" ?>
        @endforeach
        <div class="right-view">
            <div style="display: flex; flex-direction: row;">
                {{-- <div style=""> --}}
                    <select class="dropdown" name="category" id="category">
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                    </select> <br>

                    <select class="dropdown" name="category" id="category">
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                        <option>-- Select --</option>
                    </select> <br>
                {{-- </div> --}}

                <button id='popupButton'>
                    <i class='fa fa-plus-square-o'></i> 
                    Add new product 
                </button>
            </div>

            <div class="items-view">
                @foreach($items as $item)
                <div class="items"> 
                        <div class="items-pics"></div>
                        <text class="item-text"> {{ $item }} </text>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


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
                <input class="textArea" name="productType" type="text"> <br>

                <label> Brand </label> <br>
                <input class="textArea" name="productBrand" type="text"> <br>

                <input class="textButton" name="addProduct" type="submit" value="Add Product"> <br>
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
