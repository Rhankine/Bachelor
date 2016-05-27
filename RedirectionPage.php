<?php
        $studyNo = rand(0,2);
        switch ($studyNo) {
            case '0':
                header('Location: ./PieChart/FrontpagePie.php');
                break;
            case '1':
                header('Location: ./BarCharts/FrontpageBar.php');
                break;
            case '2':
                header('Location: ./LineChart/FrontpageLine.php');
                break;               
            
            default:
                header('Location: ./RedirectionPage.php');
                break;
        }
?>