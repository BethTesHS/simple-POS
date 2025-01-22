<!DOCTYPE html>
<html>
<head>
    <title>Simple Calculator</title>

    @vite(['resources/css/calc.css'])
</head>
<body>
    <h2>Simple Calculator</h2>
    <div>

        {{-- <?php $items = array(1,2,3,4,5,6,7,8,9,0) ?> --}}

        <div class="calc-view">
            <div class="calc-result">  </div>

            {{-- @foreach($items as $item)
                <div class="calc-button"> {{ $item }}</div>
            @endforeach --}}
            <div class="calc-button"> AC </div>
            <div class="calc-button"> CE </div>
            <div class="calc-button"> % </div>
            <div class="calc-button"> / </div>
            <div class="calc-button"> 7 </div>
            <div class="calc-button"> 8 </div>
            <div class="calc-button"> 9 </div>
            <div class="calc-button"> x </div>
            <div class="calc-button"> 4 </div>
            <div class="calc-button"> 5 </div>
            <div class="calc-button"> 6 </div>
            <div class="calc-button"> - </div>
            <div class="calc-button"> 1 </div>
            <div class="calc-button"> 2 </div>
            <div class="calc-button"> 3 </div>
            <div class="calc-button"> + </div>
            <div class="calc-button"> 0 </div>
            <div class="calc-button"> . </div>
            <div class="calc-button"> = </div>
        </div>

    </div>

    <h3>Result:</h3>
    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $result = '';

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = 'Error: Division by zero';
                }
                break;
            default:
                $result = 'Invalid operation';
                break;
        }

        echo "<p>$result</p>";
    }
    ?>
</body>
</html>
