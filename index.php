<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Room Sense</title>
    
    <!-- favicon -->
    <link rel=icon href="assets/img/favicon.png" sizes="20x20" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .id-text{
            color: white;
        }
    </style>

    <script>
        function showServerTime() {
            fetch('get_server_time.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('server-time').innerHTML = data;
            });
        }

        // Update server time every second
        setInterval(showServerTime, 1000);

        // Initial load of server time
        showServerTime();

                                       


    $(document).ready(function(){
    setInterval(function(){
        $.ajax({
            url: 'update_realtime_data.php',
            type: 'GET',
            success: function(response){
                console.log('Global variables updated successfully');
            },
            error: function(xhr, status, error){
                console.error('Error updating global variables:', error);
            }
        });
    }, 1000); // Update every second (1000 milliseconds)
});
                          

function fetchName() {
        fetch('fetch_name.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('name').innerText = data.name;
            })
            .catch(error => console.error('Error fetching name:', error));
    }

    // Fetch the name every second
    setInterval(fetchName, 1000);

    // Initial fetch
    fetchName();

        
        
    </script>
</head>
<body>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <?php
session_start(); // Start the session

// Check if userId is set in the session
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $accounttype=$_SESSION['accounttype'];
    $loggedin=$_SESSION['loggedin'];

    // If user is logged in, set the page to home
       
   } else {
    $userId = '';
    $accounttype='';
    $loggedin=false;

    
     
   
}
 if (!isset($_GET["page"])) {
        $_GET["page"] = "home";
    }
?>

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>

    <!-- search popup start-->
    <div class="td-search-popup" id="td-search-popup">
        <form action="index.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- header start -->
    <div class="navbar-area">
        <!-- topbar end-->
        <div class="topbar-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-7 align-self-center">
                        <div class="topbar-menu text-md-left text-center">
                            <ul class="align-self-left">
                                <li><p class="id-text"><?php if($loggedin) {echo 'Hello, ';} echo $accounttype . $userId; ?></p></li>                       
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 mt-2 mt-md-0 text-md-right text-center">
                        <div class="topbar-social">
                            <div class="topbar-date d-lg-inline-block"><i class="fa fa-calendar"></i> <?php echo  date('Y-m-d'); ?>
                            <div id="server-time">Server Time: Loading...</div>
                            </div>
                            <ul class="social-area social-area-2">
                                <img width="80vw" src="assets/img/favicon.png" alt="logo">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- topbar end-->

        <!-- adbar end-->
        <div class="adbar-area bg-black d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-5 align-self-center">
                        <div class="logo text-md-left text-center">
                            <a class="main-logo" href="index.php"><img src="assets/img/logo.png" alt="img"></a>
                        </div>
                    </div>
                    <!-- <div class="col-xl-6 col-lg-7 text-md-right text-center">
                        <a href="#" class="adbar-right">
                            <img src="assets/img/add/1.png" alt="img">
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- adbar end -->

        <!-- navbar start -->
        <nav class="navbar navbar-expand-lg">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <div class="logo d-lg-none d-block">
                        <a class="main-logo" href="index.php"><img src="assets/img/logo.png" alt="img"></a>
                    </div>
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#nextpage_main_menu" 
                    aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <!-- <div class="nav-right-part nav-right-part-mobile">
                    <a class="search header-search" href="#"><i class="fa fa-search"></i></a>
                </div> -->
                <div class="collapse navbar-collapse" id="nextpage_main_menu">
                    <ul class="navbar-nav menu-open">
                        <?php if($loggedin) { ?>
                        <li class="menu-item-has-no-children current-menu-item">
                            <a href="index.php?page=myAccount">My Account</a>  
                        </li>

                        <?php if ($accounttype=='admin') { ?>

                        <li class="menu-item-has-children current-menu-item">
                            <a>Add Records</a>  
                            <ul class="sub-menu">
                                <li><a href="index.php?page=addUsers">Add User</a> </li>                                
                                <li><a href="index.php?page=webpageUnavailable">Add Room</a></li> 
                                <li><a href='index.php?page=QGames'>Add Schedule</a></li>                           
                            </ul>                         
                        </li>
                        <li class="menu-item-has-children current-menu-item">
                            <a>Manage Records</a>  
                            <ul class="sub-menu">
                                <li><a href="index.php?page=home">Manage Users</a> </li>                                      
                                <li><a href="index.php?page=webpageUnavailable">Manage Rooms</a></li> 
                                <li><a href='index.php?page=QGames'>Manage Schedules</a></li>                           
                            </ul>                         
                        </li>
                        <?php }?>  


                        <li class="menu-item-has-no-children current-menu-item">
                            <a href="logout.php">Logout</a>                      
                        </li>
                    </ul>
                    <?php } ?>
                    <?php if(!$loggedin) { ?>
                        <li class="menu-item-has-no-children current-menu-item">
                        <a href="index.php?page=login">Login</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end -->

    <div class="container">
        <div class="section-title">
            <style>
                .form-label-right {
                    text-align: right;
                    width: 100%;
                }
            </style>

            <?php if (isset($_GET["page"])) { 
                    $getPage = trim($_GET["page"]);
                    if ($getPage == "home"){
                        include('home.php');
                    } else if ($getPage == "signup") {
                        include('signUp.php');
                    } else if ($getPage == "addUsers") {
                        include('addUsers.php');
                    } else if ($getPage == "updateUser") {
                        include('updateUser.php');
                    }  else if ($getPage == "activateUsers") {
                        include('activateUsers.php');
                    }else if ($getPage == "doactivateUsers") {
                        include('doactivateUsers.php');
                    }else if ($getPage == "login") {
                        include('login.php');
                    } else if ($getPage == "myAccount") {
                        include('myAccount.php');
                    }else if ($getPage == "editProfile") {
                        include('editProfile.php');
                    }else if ($getPage == "deleteUser") {
                        include('deleteUser.php');
                    }else if ($getPage == "changePassword") {
                        include('changePassword.php');
                    }else if ($getPage == "rechargeWallet") {
                        include('rechargeWallet.php');
                    }else if ($getPage == "myTransactions") {
                        include('myTransactions.php');
                    }else if ($getPage == "requestCashout") {
                        include('requestCashout.php');
                    }else if ($getPage == "viewTransactionRequests") {
                        include('viewTransactionRequests.php');
                    }else { 
                 include('webpageUnavailable.php'); 
                 }
                }
           
           
           ?>
           
        </div>
    </div>

    <div class="footer-area bg-black pd-top-50">
        <div class="container">
            
            
        </div>
    </div>

    <!-- back to top area start -->
    <!-- <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div> -->
    <!-- back to top area end -->

    <!-- all plugins here -->
    <script src="assets/js/vendor.js"></script>
    <!-- main js  -->
    <script src="assets/js/main.js"></script>
</body>
</html>