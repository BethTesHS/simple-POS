<body>
    <div class="productPopup-content">

        <span class="close-btn" id="closePopup2" onclick="closeAddCategory()">&times;</span>
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
</body>
