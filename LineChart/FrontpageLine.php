<?php
    session_start();
    $date = new DateTime();
    $_SESSION['filename'] = "./log/line".$date->getTimestamp().".csv";
    $_SESSION['did'] = 0;
    header('Location: http://localhost/LineChart/LineChartFilter.php');
?>