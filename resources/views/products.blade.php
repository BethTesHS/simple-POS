<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple POS</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/productsPopup.js'])
    @vite(['resources/js/productsPages.js'])
    @vite(['resources/js/products.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

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
                <li> <a href="{{ route('pos') }}> <button class= "listButton"> <i class="i fa fa-desktop"></i> POS </button> </a> </li>
                <li> <a href="{{ route('products') }}> <button style="color: white" class= "listButton" > <i class="i fa fa-shopping-basket"></i> Product </button> </a> </li>
                <li> <a href="{{ route('sales') }}> <button class= "listButton"> <i class="i fa fa-shopping-cart"></i> Sales </button> </a> </li>
            </ul>
        </div>

        {{-- -----------  MAIN VIEW ----------- --}}    
        <div class="mainviews" id="mainviews">

            <div class="mainpage">
                <div class="align">
                    <header>
                        <h1>Products</h1>
                    </header>


                    <div style="padding-bottom: 5px; display:flex; flex-direction: row">

                        <button id='popupButton2' class="popupButton2" type="button">
                            <text class='i'>
                                <i class='fa fa-plus-square-o'></i>
                            </text>
                        </button>
                        <select name="category_id" class="dropdown3 categoryFilter" id="categoryFilter">
                            <option value="0">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <button id='popupButton' class="addNewButton">
                            <text class='i'>
                                <i class='fa fa-plus-square-o'></i>
                            </text>
                            Add New Product
                        </button>
                    </div>
                </div>

                <div class="tableContainer">
                    <table class="table-sp">
                        <thead>
                        <tr>
                            <th class="th-sp">Product ID</th>
                            <th class="th-sp">Product Name</th>
                            <th class="th-sp">Stock Quantity</th>
                            <th class="th-sp">Price</th>
                            <th class="th-sp">Category</th>
                            <th class="th-sp" colspan='2'></th>
                        </tr>
                        </thead>
                        <tbody id="productTable">
                            @foreach ($products as $product)
                                <tr class="row" category-category="{{ $product->category->name }}">
                                    <td class="td-sp"> P_{{ sprintf("%006d",$product->id) }} </td>
                                    <td class="td-sp"> {{ $product->productName }} </td>
                                    <td class="td-sp"> {{ $product->stockQuantity }} </td>
                                    <td class="td-sp"> {{ $product->price}} ksh</td>
                                    <td class="td-sp"> {{ $product->category->name }} </td>
                                    <td class="td-sp" style="padding: 0px; width: 60px;">
                                        <button class="editProduct" data-id="{{ $product }}">
                                            <i style="width: 15px" class='fa fa-pencil-square-o'></i> Edit
                                        </button>
                                    </td>
                                    <td class="td-sp" style="padding: 3px; width: 60px;">
                                        <button class="deleteProduct" data-id="{{ $product }}">
                                            <i style="width: 10px" class='fa fa-trash-o'></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <button id="prevProductPage"> ‹ </button>
                        <div class="inputChange">
                            <span id="productPageIndicator">Page</span>
                        </div>
                    <button id="nextProductPage"> › </button>
                </div>
            </div>
        </div>
    </div>

    {{-------------- // POPUPS // --------------}}

    {{-- Add Product Popup --}}
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
                <div class="categoryPopup">

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

    {{-- Add Category Popup --}}
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

    {{-- Edit Product Popup --}}
    <div id="editPopupMessage" class="productPopup2">
        <div class="productPopup2-content">
            <span class="close-btn" id="closeEditPopupBtn">&times;</span>
            <div style="padding: 20px 0px">
                <h3> Edit Product </h3>
            </div>

            <form action="{{ route('products.update') }}" autocomplete="off" method="POST">
                @csrf
                @method('PUT')

                <label> ID </label> <br>
                <input style="color:gray" id="id" class="textArea" name="id" type="text" value="" readonly> <br>

                <label> Product Name</label> <br>
                <input class="textArea" id="pn" name="productName" type="text"> <br>

                <label> Stock </label>
                <div class="stock">
                    <button type="button" onclick="sub(this.closest('div').querySelector('.stock input'))" class="button"> - </button>
                        <input class="display" id="sq" name="stockQuantity" oninput="change(this.closest('div').querySelector('.stock input'))" type="text">
                    <button type="button" onclick="add(this.closest('div').querySelector('.stock input'))" class="button"> + </button>
                </div>


                <label> Price </label> <br>
                <input class="textArea" id="pr" name="price" type="number" step="any" maxlength="10"> <br>

                <label> Category </label> <br>
                <select id="cid" name="category_id" class="dropdown2 category" >
                    <option value=""> -- Select Category -- </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select> <br>

                <input class="textButton" name="editProduct" type="submit" value="Update Member"> <br>
            </form>

        </div>
    </div>

    {{-- Delete Product Popup --}}
    <div id="deletePopupMessage" class="productPopup3">
        <div class="productPopup3-content">
            <span class="close-btn" id="closeDeletePopupBtn">&times;</span>
            <div style="padding: 20px 0px">
                <h3> Delete Product </h3>
            </div>
            <form action="{{ route('products.delete') }}" autocomplete="off" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" id="d_id" class="textArea" name="id" type="text" value="">

                <div>
                    <text> Are you sure you want to remove </text> <br>
                    <b><output id="d_pn" name="productName" type="text" value=""> </output></b>
                    <text> from the system?</text>
                </div>

                <input class="textButton" name="deleteProduct" type="submit" value="Remove Member">
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