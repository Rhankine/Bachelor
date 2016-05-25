<?php
        $studyNo = rand(0,2);
        switch ($studyNo) {
            case '0':
                header('Location: http://localhost/PieChart/FrontpagePie.php');
                break;
            case '1':
                header('Location: http://localhost/BarCharts/FrontpageBar.php');
                break;
            case '2':
                header('Location: http://localhost/LineChart/FrontpageLine.php');
                break;               
            
            default:
                header('Location: http://localhost/RedirectionPage.php');
                break;
        }
?>