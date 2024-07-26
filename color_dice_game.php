<?php
session_start();

// Initialize user's balance
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 1000; // Start with $1000
}

$balance = $_SESSION['balance'];
$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $betColor = strtolower(trim($_POST['color']));
    $betAmount = intval($_POST['amount']);

    if ($betAmount > $balance) {
        $message = "You don't have enough balance to place this bet.";
    } else {
        $colors = ['red', 'green', 'blue'];
        $results = [
            $colors[array_rand($colors)],
            $colors[array_rand($colors)],
            $colors[array_rand($colors)]
        ];

        $win = count(array_filter($results, function($color) use ($betColor) {
            return $color == $betColor;
        }));

        if ($win > 0) {
            $winAmount = $betAmount * $win;
            $balance += $winAmount;
            $message = "You won! You guessed $betColor and it appeared $win time(s). You won $$winAmount.";
        } else {
            $balance -= $betAmount;
            $message = "You lost! You guessed $betColor but it did not appear.";
        }

        $_SESSION['balance'] = $balance;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Dice Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .dice {
            display: inline-block;
            margin: 10px;
            width: 100px;
            height: 100px;
            line-height: 100px;
            font-size: 24px;
            color: white;
            border: 2px solid #000;
            border-radius: 10px;
        }
        .red {
            background-color: red;
        }
        .green {
            background-color: green;
        }
        .blue {
            background-color: blue;
        }
        #betting-form {
            margin: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<h1>Color Dice Game</h1>
<div id="dice-container">
    <div class="dice" id="dice1"></div>
    <div class="dice" id="dice2"></div>
    <div class="dice" id="dice3"></div>
</div>

<form id="betting-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="color">Bet on a color (red, green, blue): </label>
    <input type="text" id="color" name="color" required>
    <label for="amount">Bet Amount: </label>
    <input type="number" id="amount" name="amount" required>
    <button type="submit">Place Bet</button>
</form>

<div id="result">
    <p id="message"><?php echo $message; ?></p>
    <p id="balance">Balance: $<?php echo $balance; ?></p>
</div>

<script>
    function rollDice() {
        const colors = ['red', 'green', 'blue'];
        const dice1 = document.getElementById('dice1');
        const dice2 = document.getElementById('dice2');
        const dice3 = document.getElementById('dice3');

        const result1 = colors[Math.floor(Math.random() * colors.length)];
        const result2 = colors[Math.floor(Math.random() * colors.length)];
        const result3 = colors[Math.floor(Math.random() * colors.length)];

        dice1.className = 'dice ' + result1;
        dice2.className = 'dice ' + result2;
        dice3.className = 'dice ' + result3;

        return [result1, result2, result3];
    }

    document.getElementById('betting-form').onsubmit = function(event) {
        event.preventDefault();
        const color = document.getElementById('color').value;
        const amount = parseInt(document.getElementById('amount').value);

        const results = rollDice();

        let win = results.filter(c => c === color).length;
        let message = '';
        if (win > 0) {
            let winAmount = amount * win;
            message = `You won! You guessed ${color} and it appeared ${win} time(s). You won $${winAmount}.`;
        } else {
            message = `You lost! You guessed ${color} but it did not appear.`;
        }

        document.getElementById('message').innerText = message;
        document.getElementById('balance').innerText = `Balance: $${amount}`;
        document.getElementById('result').classList.remove('hidden');
    };
</script>

</body>
</html>
