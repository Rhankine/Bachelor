<?php
    session_start();
    if(isset($_GET['pushed'])){
        $date = new DateTime();
        $_SESSION['filename'] = "./../log/bar".$date->getTimestamp().".csv";
        $fn = $_SESSION['filename'];
        $content = "LineID,trialno,AnswerDep,AnswerVal,Smallest Datapoint,Percent,Extend,Strategy,Liked,Improvement,Comments,age,education,Country,UserId\n";
        $LogFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($LogFile, $content);
        fclose($LogFile);
        $_SESSION['did'] = 0;
        $studyNo = rand(0,3);
        $_SESSION['studyno'] = $studyNo;
        switch ($studyNo) {
            case '0':
                header('Location: ./FrontpageBarNoInteraction.php');
                break;
            case '1':
                header('Location: ./FrontpageBarBase.php');
                break;
            case '2':
                header('Location: ./FrontpageBarReorder.php');
                break;
            case '3':
                header('Location: ./FrontpageBarFilter.php');
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
    <link rel="stylesheet" type="text/css" href="./barchart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>
    <h1>Welcome to this user perception study.</h1>
    <p>
        In this study you will see 60 pages, each with a bar chart and 2 question. It will take you about 18-20 minutes to complete.<br />
        Please read the instructions carefully and pay close attention while doing this job as you might not get paid otherwise. <br />We will ask you questions to test your level of attention.<br /><br />
        You will have the possibility of using some sort of interaction, which will be explained later.
    </p>
    <p>
        An example of the bar charts can be seen below.<br />
    </p>
        <input type='hidden' value='test' id='h_v' class='h_v'>
        <script src="./BarChartNoInteraction.js"></script>
    <p>
        You will see the two questions. <br />
        The first one "Which datapoint is smaller?". 
        To this question, please click the button you believe is correct.<br />
        The second question "How many percent is the smaller in size of the bigger?", is asking you to judge, 
        how many percent the value of the smaller bar is of the bigger.<br />
        When you have filled in the two question, please click submit, and you will be taken to the next task.
    </p>
    <p>
        The time spent completing a task will be logged. Please do focus on the tasks while performing them. 
        But do not hurry, I seek to log a time as realistic as possible.<br />
    </p>
    
    <form method="get">
        <input type="hidden" name="pushed" value="is" />
        <input type="submit" id="btnSubmit" value="Continue" />
    </form>
</body>