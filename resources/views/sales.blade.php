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
        use App\Models\Sale;
        $sales = Sale::all();
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

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.detailView-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const sales = JSON.parse(button.getAttribute('data-id'));
                    const id = document.getElementById('con_id');
                    id.value = sales['id'];
                    document.getElementById('salesDetailPopup').style.display = 'flex';
                });
            });
        });

        function closeSalesPopupBtn() {
            document.getElementById('salesDetailPopup').style.display = 'none'; // Hide the popup
        }

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
        <div class="sidebar">
            <ul>
                <li> <a href="\salesDetail"> <button class= "listButton"> <i class="i fa fa-handshake-o"></i> Sales </button> </a> </li>
                <li> <a href="\salesAnalysis"> <button class= "listButton" > <i class="i fa fa-line-chart"></i> Analysis </button> </a> </li>
            </ul>
        </div>

        <div class="mainviews" id="mainviews">

            {{-- <div class="mainpage"> --}}
                <div class="align">
                    <header>
                        <h1>Sales</h1>
                    </header>
                    {{-- <button class="addNewButton" id='addMember'><i class='fa fa-plus-square-o'></i> Add new member </button> --}}
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>Reciept ID</th>
                        <th>Date</th>
                        <th>Total Quantity</th>
                        <th>Total Price</th>
                        <th>Payment Detail</th>
                        <th style="width: 10%"></th>
                        {{-- <th colspan='2'></th> --}}
                    </tr>
                    </thead>
                    <tbody>

                        @foreach ($sales as $sale)
                            <tr>
                                <td> {{ sprintf("%010d", $sale->id) }} </td>
                                <td> {{ $sale->created_at }} </td>
                                <td> {{ $sale->totalQuantity }} </td>
                                <td> {{ $sale->totalPrice }} </td>
                                <td> {{ $sale->payMethod }} </td>
                                <td style="padding: 0px; width: 60px;">
                                    <button class="detailView-btn" data-id="{{ $sale }}">
                                        {{-- <i style="width: 0px" class='fa fa-eye'></i>  --}}
                                        View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($errors->any())
                    <div class="alert alert-danger" style="color:red; padding-left: 20px;">
                        <div>
                            @foreach($errors->all() as $error)
                            <br> <p>{{ $error }}</p>
                            @endforeach
                        </div>                        
                    </div>
                @endif
            {{-- </div> --}}


            {{-------------- // EDIT // --------------}}


            <div id="salesDetailPopup" class="salesDetail">
                <div class="salesDetail-content">
                    <span class="close-btn" onclick="closeSalesPopupBtn()">&times;</span>
                    <div style="padding: 20px 0px">
                        <h3> Sales Detail </h3>
                    </div>

                    {{-- <form action="{{ route('contribution.update') }}" autocomplete="off" method="POST">
                        @csrf
                        @method('PUT') --}}

                        <input type="text" id="con_id" class="textArea" name="id" type="text" value="" readonly>

                        <input class="textButton" name="editMember" type="submit" value="Update Detail"> <br>
                    {{-- </form> --}}
                </div>
            </div>

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
