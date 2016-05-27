<?php
    session_start();
    if(isset($_GET['pushed'])){
        $date = new DateTime();
        $_SESSION['filename'] = "./../log/line".$date->getTimestamp().".csv";
        $fn = $_SESSION['filename'];
        $content = "LineID,Smallest Datapoint,Percent,Extend,Strategy,Liked,Improvement,Comments,age,education,Country,UserId\n";
        $LogFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($LogFile, $content);
        fclose($LogFile);
        $_SESSION['did'] = 0;
        $studyNo = rand(0,5);
        $_SESSION['studyno'] = $studyNo;
        switch ($studyNo) {
            case '0':
                header('Location: ./FrontpageLineNoInt.php');
                break;
            case '1':
                header('Location: ./FrontpageLineNoInt.php');
                break;
            case '2':
                header('Location: ./FrontpageLineBase.php');
                break;
            case '3':
                header('Location: ./FrontpageLineBase.php');
                break;
            case '4':
                header('Location: ./FrontpageLineFilter.php');
                break;
            case '5':
                header('Location: ./FrontpageLineFilter.php');
                break;
            default:
                header('Location: ./');
                break;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
    <h1>Welcome to this user perception study.</h1>
    <p>In this study you will meet 30 pages, each with a line chart and 2 question. It will take you about 30 minutes to complete.<br /> 
        You will be asked to compare 2 of the points in the line chart and tell, how big - in percent - the smaller valued point is of the bigger.<br />
        You will have the possibility of using some sort of interaction, which will be explained later.
    </p>
    <p>
        Each of the 30 pages will look similar to the image below.<br />
        <img src="./line.jpg" border="5"><br />
        You will see the two questions. <br />
        The first one "Which datapoint is smaller?". 
        To this question, please click the button you believe is correct.<br />
        The second question "How many percent is the smaller in size of the bigger?", is asking you to judge, 
        how many percent the value of the smaller valued datapoint is of the bigger.<br />
        When you have filled in the two question, please click submit, and you will be taken to the next task.
    </p>
    <p>
        The time spent completing a task will be logged. Please do focus on the tasks while performing them. 
        But do not hurry, I seek to log a time as realistic as possible.<br />
        Please be aware that there will appear some easy questions, to verify that you pay attention. You will not be payed if you do not correctly answers these. 
    </p>
    
    <form method="get">
        <input type="hidden" name="pushed" value="is" />
        <input type="submit" id="btnSubmit" value="Continue" />
    </form>
</body>