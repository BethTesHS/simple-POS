<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple POS</title>

    @vite(['resources/css/all.css'])
    @vite(['resources/js/customersPopup.js'])
    @vite(['resources/js/usersPages.js'])
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
                <li> <a href="{{ route('pos') }}"> <button class= "listButton"> <i class="i fa fa-desktop"></i> POS </button> </a> </li>
                <li> <a href="{{ route('products') }}"> <button class= "listButton" > <i class="i fa fa-shopping-basket"></i> Product </button> </a> </li>
                <li> <a href="{{ route('sales') }}"> <button class= "listButton"> <i class="i fa fa-shopping-cart"></i> Sales </button> </a> </li>
                <li> <a href="{{ route('stocks') }}"> <button class= "listButton"> <i class="i fa fa-line-chart"></i> Stocks </button> </a> </li>
                <li> <a href="{{ route('partial') }}"> <button class= "listButton"> <i class="i fa fa-money"></i> Partial <br>Payments </button> </a> </li>
                <li> <a href="{{ route('users') }}"> <button class= "listButton"> <i class="i fa fa-user"></i> Users </button> </a> </li>
                <li> <a href="{{ route('customers') }}"> <button style="color: white" class= "listButton" > <i class="i fa fa-users"></i> Customers </button> </a> </li>
                <hr style="border: 0.5px solid #4372a7; width: 90%; margin: 10px;">
                <li> <form action="{{ route('logout') }}" method="POST"> @csrf <button class= "listButton" type="submit"> <i class="i fa fa-sign-out"></i> Logout </button> </form> </li>
            </ul>
        </div>

        {{-- -----------  MAIN VIEW ----------- --}}
        <div class="mainviews" id="mainviews">

            <div class="mainpage">
                <div class="align">
                    <header>
                        <h1>Customers</h1>
                    </header>


                    <div style="padding-bottom: 5px; display:flex; flex-direction: row">

                        @if (auth()->user()->admin)
                            <button id='popupButton' class="addNewButton">
                                <text class='i'>
                                    <i class='fa fa-plus-square-o'></i>
                                </text>
                                Add New Customer
                            </button>
                        @else
                            <button id='unPopupButton' class="addNewButton" style="background-color: gray;">
                                <text class='i'>
                                    <i class='fa fa-plus-square-o'></i>
                                </text>
                                Add New Customer
                            </button>
                        @endif

                    </div>
                </div>

                <div class="tableContainer">
                    <table class="table-sp">
                        <thead>
                        <tr>
                            <th class="th-sp">User ID</th>
                            <th class="th-sp">First Name</th>
                            <th class="th-sp">Last Name</th>
                            <th class="th-sp">Phone Number</th>
                            @if (auth()->user()->admin)
                                <th class="th-sp" colspan='2'></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody id="productTable">
                            @foreach ($customers as $customer)
                                <tr class="row">
                                    <td class="td-sp"> {{ sprintf("%006d",$customer->id) }} </td>
                                    <td class="td-sp"> {{ $customer->firstName }} </td>
                                    <td class="td-sp"> {{ $customer->lastName }} </td>
                                    <td class="td-sp"> {{ '+254 ' . $customer->phoneNo }} </td>
                                    @if (auth()->user()->admin)
                                        <td class="td-sp" style="padding: 0px; width: 60px;">
                                            <button class="editProduct" data-id="{{ $customer }}">
                                                <i style="width: 15px" class='fa fa-pencil-square-o'></i> Edit
                                            </button>
                                        </td>
                                        <td class="td-sp" style="padding: 3px; width: 60px;">
                                            <button class="deleteProduct" data-id="{{ $customer }}">
                                                <i style="width: 10px" class='fa fa-trash-o'></i> Delete
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <button id="prevUserPage"> ‹ </button>
                        <div class="inputChange">
                            <span id="userPageIndicator">Page</span>
                        </div>
                    <button id="nextUserPage"> › </button>
                </div>
            </div>
        </div>
    </div>

    {{-------------- // POPUPS // --------------}}

    {{-- Add Customer Popup --}}
    <div id="popupMessage" class="productPopup">
        <div class="productPopup-content">

            <span class="close-btn" id="closePopup">&times;</span>
            <div style="padding: 20px 0px">
                <h2> Add New Customer </h2>
            </div>

            <form action="{{ route('customers.store') }}" autocomplete="off" method="POST">
                @csrf

                <label> First Name</label> <br>
                <input class="textArea" name="firstName" type="text"> <br>

                <label> Last Name</label> <br>
                <input class="textArea" name="lastName" type="text"> <br>

                <label> Phone Number </label> <br>
                <text style="font-size: 14px">+254 </text>
                <input style="width: 90%" class="textArea" name="phoneNo" type="number" step="any" maxlength="10"> <br>

                <input class="textButton" name="addCustomer" type="submit" value="Add Customer"> <br>
            </form>
        </div>
    </div>

    {{-- Edit Customer Popup --}}
    <div id="editPopupMessage" class="productPopup2">
        <div class="productPopup2-content">
            <span class="close-btn" id="closeEditPopupBtn">&times;</span>
            <div style="padding: 20px 0px">
                <h3> Edit Customer </h3>
            </div>

            <form action="{{ route('customers.update') }}" autocomplete="off" method="POST">
                @csrf
                @method('PUT')

                <label> ID </label> <br>
                <input style="color:gray" id="id" class="textArea" name="id" type="text" value="" readonly> <br>

                <label> First Name</label> <br>
                <input class="textArea" id="fn" name="firstName" type="text"> <br>

                <label> Last Name</label> <br>
                <input class="textArea" id="ln" name="lastName" type="text"> <br>

                <label> Phone Number </label> <br>
                <text style="font-size: 14px">+254 </text>
                <input style="width: 90%" class="textArea" id="pno" name="phoneNo" type="number" step="any" maxlength="10"> <br>

                <input class="textButton" name="editCustomer" type="submit" value="Update Customer"> <br>
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
            <form action="{{ route('customers.delete') }}" autocomplete="off" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" id="d_id" class="textArea" name="id" type="text" value="">

                <div>
                    <text> Are you sure you want to remove </text> <br>
                    <b><output id="d_fn" name="fullName" type="text" value=""> </output></b>
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
