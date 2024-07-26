<?php
session_start();

// Assuming these session variables are set when the user logs in
$accounttype = $_SESSION['accounttype'];
$name = $_SESSION['fname'] . " " . $_SESSION['lname'];
$username = $_SESSION['username'];
$userId = $_SESSION['userId'];

// Function to generate a unique reference number
function generateReferenceNumber() {
    return uniqid('ref_', true);
}

$referenceNumber = generateReferenceNumber();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recharge</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card-header, .card-body {
            text-align: center;
        }
        .progress {
            margin-top: 20px;
        }
        .btn-custom {
            margin: 10px 5px;
        }
        .btn {
            vertical-align: middle;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Recharge</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>User ID:</strong> <?php echo $userId; ?><br>
                            <strong>Username:</strong> <?php echo $username; ?><br>
                            <strong>Reference Number:</strong> <span id="reference-number"><?php echo $referenceNumber; ?></span>
                        </p>
                        <div class="progress">
                            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="#" id="recharge-btn" class="btn btn-danger btn-custom">Start Recharge</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('recharge-btn').addEventListener('click', function() {
            let progressBar = document.getElementById('progress-bar');
            let width = 0;
            let interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                    progressBar.innerText = "Completed";
                } else {
                    width++;
                    progressBar.style.width = width + '%';
                    progressBar.setAttribute('aria-valuenow', width);
                    progressBar.innerText = width + '%';
                }
            }, 100); // Adjust the interval time for faster/slower progress
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
