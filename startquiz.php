<?php

require_once "config.php";

session_start();

if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    exit;
}

$userId = $_SESSION['userId'];

// Retrieve account details from the database
$query = "SELECT * FROM account WHERE userId = '$userId'";
$result = mysqli_query($link, $query);

if (!$result) {
    die("Error in query: $query ." . mysqli_error($link));
}

$row = mysqli_fetch_assoc($result);
$taskpoints = $row['task-rewards'];

// Retrieve questions and answers from the database
$questionsQuery = "SELECT * FROM questions";
$questionsResult = mysqli_query($link, $questionsQuery);

if (!$questionsResult) {
    die("Error in query: $questionsQuery ." . mysqli_error($link));
}

$questions = [];
while ($row = mysqli_fetch_assoc($questionsResult)) {
    $questions[] = $row;
}

if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
}

$currentQuestionIndex = $_SESSION['current_question'];
$currentQuestion = $questions[$currentQuestionIndex];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userAnswer = $_POST["answer"];
    $correctAnswer = $currentQuestion['correct_answer'];

    if ($userAnswer == $correctAnswer) {
        $message = "Correct! You answered correctly.";
        $taskpoints = round(($taskpoints + 0.01), 2);
        $sql2 = "UPDATE account SET `task-rewards` = $taskpoints WHERE userId = '$userId'";
        $result2 = mysqli_query($link, $sql2);
    } else {
        $message = "Wrong! The correct answer was $correctAnswer.";
    }

    $_SESSION['current_question']++;
    if ($_SESSION['current_question'] >= count($questions)) {
        $_SESSION['current_question'] = 0; // Reset for the next session
        $message .= " Quiz completed!";
    }

    echo "<script>
        $(document).ready(function() {
            $('#resultModal').modal('show');
        });
    </script>";
}

// Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz App</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .toggle-btn-group .btn {
            margin: 5px 0;
            width: 100%;
        }
        .toggle-btn-group .btn input[type="radio"] {
            display: none;
        }
        .toggle-btn-group .btn.active {
            background-color: #007bff;
            color: white;
        }
        #vermessagec, #vermessagew {
            text-align: center;
        }
    </style>
    <script>
        function showBalance() {
            fetch('get_wallet_balance.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('wallet-balance').innerHTML = data;
                });
        }

        // Update server time every second
        setInterval(showBalance, 1000);

        // Initial load of server time
        showBalance();
    </script>
</head>
<body>
<br>
<br>
<div id="wallet-balance">
    <div class="d-flex justify-content-end">
        <label for="formGroupExampleInput" class="form-label-right">Task Points: <?php echo $taskpoints; ?></label>
    </div>
    <div class="d-flex justify-content-end">
        <label for="formGroupExampleInput" class="form-label-right">Referral Bonus: </label>
    </div>
    <div class="d-flex justify-content-end">
        <label for="formGroupExampleInput" class="form-label-right">Available Balance: </label>
    </div>
</div> <br>

<?php if (isset($message)) { ?>
    <div class="alert alert-info text-center"><?php echo $message; ?></div>
<?php } ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="card text-center mb-3">
        <div class="card-header">
            <h6 class="card-title"><?php echo $currentQuestion['question']; ?></h6>
        </div>
        <div class="card-body">
            <?php
            $answers = explode(',', $currentQuestion['answers']);
            ?>
            <div class="btn-group btn-group-toggle toggle-btn-group" data-toggle="buttons">
                <?php foreach ($answers as $answer) { ?>
                    <label class="btn btn-outline-primary">
                        <input type="radio" name="answer" value="<?php echo $answer; ?>"> <?php echo $answer; ?>
                    </label>
                <?php } ?>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Submit">
</form>

<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel">Quiz Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $message; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-group-toggle .btn').click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
</body>
</html>
