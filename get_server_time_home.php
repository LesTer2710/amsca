<?php
date_default_timezone_set('Asia/Manila');

// Fetch and display server time
$timestamp= time();
$formattedTime=date("h:i", $timestamp);
$formattedA=date("A", $timestamp);

echo "<style>
.formattedA{
display: inline;

}

.date {
font-size: 15px;
font-weight: normal;
}

.time{
font-size: 45px;
display:inline;

}
</style>";

echo "<h5 class='time'>".$formattedTime."</h5>" ." <h6 class='formattedA'>".$formattedA."</h6>";
echo "<h6 class='date'>".date('l, F j')."</h6>";
?>
