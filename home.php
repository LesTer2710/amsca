
<script>
        function showServerTime() {
            fetch('get_server_time_home.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('server-timehome').innerHTML = data;
            });
        }

        // Update server time every second
        setInterval(showServerTime, 1000);

        // Initial load of server time
        showServerTime();
</script>
<style>
    .card-title{
        color: white;
    }
</style>

<br>

<div id="server-timehome" class="text-center"></div>



<br>


    <div class="card text-center">
        <div class="card-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs">
                <h5 class="card-title">Available Rooms</h5>
            </ul>
        </div>
    </div>

    <style>
        .reduced-line-break{
            line-height:0.5;
        }

        .reduced-line-break br{
            display: block;
            margin:0;
            line-height: 0.5;
        }

        .card-body{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .book-room-btn{
            text-align: center;
            flex-grow: 1;
           
        }

        .book-room-btn button{
            margin-left: 20px;
            
        }

        .small-button{
            padding: 5px 10px;
            font-size: 14px;
        }



    </style>

    <?php
    

    if(!isset($_SESSION['loggedin'])){
        $loggedin=false;
    }else{
        $loggedin=$_SESSION['loggedin'];
    }
    
    
    ?>



    <div class='reduced-line-break'> <br> </div>

    <div class='card text-start'>
        <div class="card-body">
            <div class='room-info'>
                <h5 class="help-block text-dark">Computer Lab 1</h5>
                <span class="help-block text-dark">Available: 7:30-10:30</span>
            </div>
            <div class='book-room-btn'>
                <?php if($loggedin){?>
                <button class='btn btn-primary small-button'>Book Room</button>
                <?php }?>
            </div>
                
        </div>
    </div>

    <div class='reduced-line-break'> <br> </div>

    <div class='card text-start'>
        <div class="card-body">
            <div class='room-info'>
                <h5 class="help-block text-dark">Computer Lab 2</h5>
                <span class="help-block text-dark">Available: 7:30-10:30</span>
            </div>
            <div class='book-room-btn'>
                <?php if($loggedin){?>
                <button class='btn btn-primary small-button'>Book Room</button>
                <?php }?>
            </div>
                
        </div>
    </div>

    <div class='reduced-line-break'> <br> </div>

    <div class='card text-start'>
        <div class="card-body">
            <div class='room-info'>
                <h5 class="help-block text-dark">Computer Lab 4</h5>
                <span class="help-block text-dark">Available: 7:30-10:30</span>
            </div>
            <div class='book-room-btn'>
                <?php if($loggedin){?>
                <button class='btn btn-primary small-button'>Book Room</button>
                <?php }?>
            </div>
                
        </div>
    </div>

    <div class='reduced-line-break'> <br> </div>

    <div class='card text-start'>
        <div class="card-body">
            <div class='room-info'>
                <h5 class="help-block text-dark">Computer Lab 6</h5>
                <span class="help-block text-dark">Available: 7:30-10:30</span>
            </div>
            <div class='book-room-btn'>
                <?php if($loggedin){?>
                <button class='btn btn-primary small-button'>Book Room</button>
                <?php }?>
            </div>
                
        </div>
    </div>

    
    

