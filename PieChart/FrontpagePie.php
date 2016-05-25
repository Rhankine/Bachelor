<?php
    session_start();
    if(isset($_GET['pushed'])){
        $date = new DateTime();
        $_SESSION['filename'] = "./log/line".$date->getTimestamp().".csv";
        $_SESSION['did'] = 0;
        header('Location: http://localhost/PieChart/PieChart.php');    
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
    <h1>Welcome to this user perception study.</h1>
    <p>In this study you will meet 15 pages, each with a pie chart and 2 question. 
        You will be asked to compare 2 of the pies in the pie chart and tell, how big - in percent - the smaller pie is of the bigger.<br />
        You will have the possibility of using some sort of interaction, which will be explained later.
    </p>
    <p>
        Each of the 15 pages will look similar to the image below.<br />
        <img src="pie.jpg" border="5"><br />
        Just below the chart, there are two buttons: left and right. These will rotate the pie counterclockwise 
        and clockwise respectively.<br />
        Below this, you will see the two questions. <br />
        The first one "Which pie is smaller?". 
        To this question, please click the button you believe is correct.<br />
        The second question "How many percent is the smaller in size of the bigger?", is asking you to judge, 
        how many percent of the bigger pie, the smaller will fill.<br />
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