<?php
$accounttype=$_SESSION['accounttype'];
$name=$_SESSION['fname']." ".$_SESSION['lname'];
$username=$_SESSION['username'];
$userId=$_SESSION['userId'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card-header, .card-body {
            text-align: center;
        }
        .profile-icon {
            font-size: 5rem;
            color: #6c757d;
        }
        .card-title {
            margin-top: 10px;
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
                        <h3>User Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-circle profile-icon"></i>
                                <!-- <img src="assets/img/favicon.png" width="150vw" alt=""> -->
                            </div>
                            <div class="col-md-8">
                                <h4 class="card-title" id="name-myacct"></h4>
                                <p class="card-text">
                                    <strong>User ID:</strong> <span id="myacct-id"></span>
                                     
                                    <br>
                                    <strong>Username:</strong> <span id="myacct-username"></span><br>
                                  
                                    
                                </p>
                                <a href="index.php?page=editProfile" class="btn btn-primary btn-custom">Edit Profile</a>
                                <a href="index.php?page=changePassword" class="btn btn-secondary btn-custom">Change Password</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        function showAcctType() {
            fetch('get_accounttype.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('acct-type').innerHTML = data;
                });
        }

        setInterval(showAcctType, 1000);
        showAcctType();

        function showBalanceMyAcct() {
            fetch('get_wallet_balance-myacct.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('wallet-myacct').innerHTML = data;
                });
        }

        setInterval(showBalanceMyAcct, 1000);
        showBalanceMyAcct();

        // =============REALTIME DATA FETCH

        function fetchRealtimeData() {
            
        fetch('fetch_realtimedata.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('myacct-id').innerText = data.userId;
                document.getElementById('name-myacct').innerHTML = data.name;
                document.getElementById('myacct-username').innerHTML = data.username;
                
            })
            .catch(error => console.error('Error fetching realtime data:', error));
    }

    // Fetch the realtime data every second
    setInterval(fetchRealtimeData, 1000);

    // Initial fetch
    fetchRealtimeData();

       
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
