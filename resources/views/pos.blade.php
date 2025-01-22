<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>

    <title>Document</title>

    @vite(['resources/css/style.css'])


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>
<body>


    <div class="navbar">
        <h2>Dashboard</h2>
    </div>

    <div class="wrapper">
        <div class="left-view">
            {{--  --}}
        </div>

        <?php $items = array('Water', 'Book', 'Pen', 'Bottle', 'Coke'); ?>

        <div class="calc">
            @foreach($items as $item)
                <div class="items"> {{ $item }}</div>
            @endforeach
        </div>

        {{-- <div class="mainviews" id="mainviews">
            <header>
                <h1>Welcome to the Home Page</h1>
            </header>
            <section>
                <p>This is a sample page to showcase a sidebar layout with animated buttons and links. Enjoy the smooth transitions!</p> <br>
                <p>Click the button below to open this link: </p>
                <p>https://dribbble.com/tags/welcome-page </p> <br>
            </section>
            <footer>
                <button class="animated-btn"><a href="https://dribbble.com/tags/welcome-page" target="_blank">Click Me</a></button>
            </footer>
        </div> --}}
    </div>



</body>
</html>
