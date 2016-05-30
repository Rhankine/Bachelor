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
        $studyNo = rand(0,1);
        $_SESSION['studyno'] = $studyNo;
        switch ($studyNo) {
            case '0':
                header('Location: ./FrontpagePieNoInteraction.php');
                break;
            case '1':
                header('Location: ./FrontpagePieRotate.php');
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
    <p>In this study you will meet 30 pages, each with a pie chart and 2 question. It will take you about 10-12 minutes to complete.<br />
        You will be asked to compare 2 of the slices in the pie chart and tell, how big - in percent - the smaller slice is of the bigger.<br />
        You will have the possibility of using some sort of interaction, which will be explained later.
    </p>
    <p>
        Each of the 30 pages will have a chart like the one below.<br />
        <img src="./pie.jpg" border="5"><br />
        Below this, you will see the two questions. <br />
        The first one "Which slice is smaller?". 
        To this question, please click the button you believe is correct.<br />
        The second question "How many percent is the smaller in size of the bigger?", is asking you to judge, 
        how many percent of the bigger slice, the smaller will fill.<br />
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