{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>

    @vite(['resources/css/all.css'])

</head> --}}
<body>
    <div class="triangle">
    </div>
    <div class="calc">
        {{-- <span class="calcClose" id="closeCalcPopupBtn" onclick="calcClosePopup()">&times;</span> --}}
        <div class="calc-result" id="result">0</div>
        <div class="calc-view">
            <button class="calc-button" onclick="clearAll()">AC</button>
            <button class="calc-button" onclick="appendBracket('(')">(</button>
            <button class="calc-button" onclick="appendBracket(')')">)</button>
            <button class="calc-button" onclick="appendOperator('%')">%</button>
            <button class="calc-num" onclick="appendNumber(7)">7</button>
            <button class="calc-num" onclick="appendNumber(8)">8</button>
            <button class="calc-num" onclick="appendNumber(9)">9</button>
            <button class="calc-button" onclick="appendOperator('/')">/</button>
            <button class="calc-num" onclick="appendNumber(4)">4</button>
            <button class="calc-num" onclick="appendNumber(5)">5</button>
            <button class="calc-num" onclick="appendNumber(6)">6</button>
            <button class="calc-button" onclick="appendOperator('*')">x</button>
            <button class="calc-num" onclick="appendNumber(1)">1</button>
            <button class="calc-num" onclick="appendNumber(2)">2</button>
            <button class="calc-num" onclick="appendNumber(3)">3</button>
            <button class="calc-button" onclick="appendOperator('-')">-</button>
            <button class="calc-num" onclick="appendNumber(0)">0</button>
            <button class="calc-button" onclick="appendDot()">.</button>
            <button class="calc-button" onclick="calculateResult()">=</button>
            <button class="calc-button" onclick="appendOperator('+')">+</button>
        </div>
    </div>

    <script>
        let equation = '';
        let currentInput = '';

        function appendNumber(number) {
            currentInput += number;
            equation += number;
            updateDisplay();
        }

        function appendOperator(op) {
            if (currentInput === '' && equation.slice(-1).match(/[\+\-\*\/%]/)) {
                equation = equation.slice(0, -1); // Replace the last operator if already present
            }
            if (currentInput !== '' || equation !== '') {
                equation += op;
                currentInput = ''; // Reset the current input after an operator
                updateDisplay();
            }
        }

        function appendBracket(bracket) {
            if (bracket === '(') {
                equation += bracket;
            } else if (bracket === ')' && isValidClosingBracket()) {
                equation += bracket;
            }
            currentInput = ''; // Reset current input when adding brackets
            updateDisplay();
        }

        function isValidClosingBracket() {
            const openBrackets = (equation.match(/\(/g) || []).length;
            const closeBrackets = (equation.match(/\)/g) || []).length;
            return openBrackets > closeBrackets;
        }

        function appendDot() {
            if (!currentInput.includes('.')) {
                currentInput += '.';
                equation += '.';
                updateDisplay();
            }
        }

        function clearAll() {
            currentInput = '';
            equation = '';
            updateDisplay();
        }

        function calculateResult() {
            try {
                const result = eval(equation.replace('x', '*')); // Evaluate the equation
                equation = result.toString(); // Set the result as the new equation
                currentInput = result.toString(); // Update current input for further operations
                updateDisplay();
            } catch (error) {
                equation = 'Error';
                currentInput = '';
                updateDisplay();
            }
        }

        function updateDisplay() {
            const display = document.getElementById('result');
            display.textContent = equation || '0';
        }

        // Add keyboard input functionality
        document.addEventListener('keydown', (event) => {
            const key = event.key;
            if (!isNaN(key)) {
                appendNumber(key);
            } else if (['+', '-', '*', '/', '%'].includes(key)) {
                appendOperator(key);
            } else if (key === '(' || key === ')') {
                appendBracket(key);
            } else if (key === '.') {
                appendDot();
            } else if (key === 'Enter') {
                calculateResult();
            } else if (key === 'Backspace') {
                clearAll(); // Clear all input for simplicity
            }
        })
    </script>
</body>
{{-- </html> --}}
