<?php
    session_start();
    if(isset($_GET['pushed'])){
        $date = new DateTime();
        $_SESSION['filename'] = "./../log/bar".$date->getTimestamp().".csv";
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
                header('Location: ./FrontpageBarFilter.php');
                break;
            case '1':
                header('Location: ./FrontpageBarFilter.php');
                break;
            case '2':
                header('Location: ./FrontpageBarReorder.php');
                break;
            case '3':
                header('Location: ./FrontpageBarReorder.php');
                break;
            case '4':
                header('Location: ./FrontpageBarBase.php');
                break;
            case '5':
                header('Location: ./FrontpageBarBase.php');
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
    <p>In this study you will meet 45 pages, each with a bar chart and 2 question. 
        You will be asked to compare 2 of the bars in the bar chart and tell, how big - in percent - the smaller bar is of the bigger.<br />
        You will have the possibility of using some sort of interaction, which will be explained later.
    </p>
    <p>
        Each of the 45 pages will look similar to the image below.<br />
        <img src="./Bar.jpg" border="5"><br />
        You will see the two questions. <br />
        The first one "Which datapoint is smaller?". 
        To this question, please click the button you believe is correct.<br />
        The second question "How many percent is the smaller in size of the bigger?", is asking you to judge, 
        how many percent the value of the smaller valued datapoint is of the bigger.<br />
        When you have filled in the two question, please click submit, and you will be taken to the next task.
    </p>
    <p>
        The time spent completing a task will be logged. Please do focus on the tasks while performing them. 
        But do not hurry, I seek to log a time as realistic as possible.    
    </p>
    
    <form method="get">
        <input type="hidden" name="pushed" value="is" />
        <input type="submit" id="btnSubmit" value="Continue" />
    </form>
</body>