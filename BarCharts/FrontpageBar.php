<?php
    session_start();
    $date = new DateTime();
    $_SESSION['filename'] = $date->getTimestamp()."csv";
    header('Location: http://localhost/BarCharts/BarChartFilter.php');
?>