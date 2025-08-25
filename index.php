<?php

$result = '';
$error = '';
if (isset($_POST['calculate'])) {
    $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
    
    switch ($operation) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                $error = "Error: Cannot divide by zero!";
            }
            break;
        default:
            $error = "Please select an operation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f0f0;
        }
        
        .calculator {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .input-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        
        input[type="number"], select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        input[type="number"]:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }
        
        select {
            cursor: pointer;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        .btn-clear {
            background-color: #6c757d;
        }
        
        .btn-clear:hover {
            background-color: #545b62;
        }
        
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            color: #155724;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        
        .error {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            color: #721c24;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>🧮 Simple Calculator</h1>
        
        <form method="POST" action="">
            <div class="input-group">
                <label for="num1">First Number:</label>
                <input type="number" step="any" id="num1" name="num1" 
                       value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>" 
                       placeholder="Enter first number" required>
            </div>
            
            <div class="input-group">
                <label for="operation">Operation:</label>
                <select id="operation" name="operation" required>
                    <option value="">Choose operation</option>
                    <option value="+" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '+') ? 'selected' : ''; ?>>
                        Addition (+)
                    </option>
                    <option value="-" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '-') ? 'selected' : ''; ?>>
                        Subtraction (-)
                    </option>
                    <option value="*" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '*') ? 'selected' : ''; ?>>
                        Multiplication (×)
                    </option>
                    <option value="/" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '/') ? 'selected' : ''; ?>>
                        Division (÷)
                    </option>
                </select>
            </div>
            
            <div class="input-group">
                <label for="num2">Second Number:</label>
                <input type="number" step="any" id="num2" name="num2" 
                       value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>" 
                       placeholder="Enter second number" required>
            </div>
            
            <button type="submit" name="calculate" class="btn">Calculate</button>
            <button type="button" class="btn btn-clear" onclick="clearForm()">Clear</button>
        </form>
        
        <?php if ($result !== '' && $error === ''): ?>
            <div class="result">
                Result: <?php 
                    echo htmlspecialchars($_POST['num1']) . ' ' . htmlspecialchars($_POST['operation']) . ' ' . htmlspecialchars($_POST['num2']) . ' = ' . number_format($result, 2); 
                ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error !== ''): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        function clearForm() {
            document.getElementById('num1').value = '';
            document.getElementById('num2').value = '';
            document.getElementById('operation').value = '';
            
           
            const result = document.querySelector('.result');
            const error = document.querySelector('.error');
            if (result) result.remove();
            if (error) error.remove();
        }
    </script>
</body>
</html>
