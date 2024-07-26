<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unavailable Feature</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        .full-height-container {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
           
            position: relative;
            z-index: 2; /* Ensures it appears above other content */
        }

        .unavailable-message {
            text-align: center;
            font-size: 2em;
            font-weight: medium;
            color: #dc3545;
            animation: fadeIn 2s ease-in-out;
        }

        .icon {
            font-size: 4em;
            color: #dc3545;
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>
<body>
    <!-- Main Navigation (if needed) -->
    <!-- Your existing navigation code -->

    <div class="full-height-container">
        <div class="unavailable-message">
            <div class="icon bounce">
                <i class="fas fa-times-circle"></i>
            </div>
            Oopps! This feature is unavailable for your account.
        </div>
    </div>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
