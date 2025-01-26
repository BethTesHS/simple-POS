<body>
    <div class="productPopup-content">

        <span class="close-btn" id="closePopup" onclick="closeAddProduct()">&times;</span>
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
                <button id='popupButton2' class="popupButton2" type="button" onclick="addCategory()">
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
</body>
