<?php
    session_start();
    $date = new DateTime();
    $_SESSION['filename'] = "./log/bar".$date->getTimestamp().".csv";
    $_SESSION['did'] = 0;
    header('Location: http://localhost/BarCharts/BarChartReorder.php');
?>