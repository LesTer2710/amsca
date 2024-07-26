<?php
date_default_timezone_set('Asia/Manila');

// Fetch and display server time
$timestamp= time();
$formattedTime=date("h:i:s A", $timestamp);

echo $formattedTime . "<br>";
?>
