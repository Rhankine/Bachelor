<?php
    session_start();
    if(isset($_GET['pushed'])){
        $_SESSION['did'] = 0;
        header('Location: ./PieChartRotate.php');    
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./PieChart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <title>Page Title</title>
</head>
<body>
    <h1>Rotate</h1>
    <p>In the next 15 tasks, you will be presented with a pie chart, like the one bellow. This pie chart has the interaction type rotate.
        <br />This means that you can press either of the buttons left and right, which will make the pie chart turn counterclockwise or clockwiser respectively. You can try on the chart below.
    </p>
        <input type='hidden' value='test' id='h_v' class='h_v'>
        <script src="./PieChartRotate.js"></script>
    <p>
        You will see the two questions. <br />
        The first one "Which slice is smaller?". 
        To this question, please click the button you believe is correct.<br />
        The second question "How many percent is the smaller in size of the bigger?", is asking you to judge, 
        how many percent the value of the smaller valued datapoint is of the bigger.<br />
        When you have filled in the two question, please click submit, and you will be taken to the next task.
    </p>
    <p>
        The time spent completing a task will be logged. Please do focus on the tasks while performing them. 
        But do not hurry, I seek to log a time as realistic as possible.<br />
    </p>
    <p>
        Please click continue when you are ready to start the tasks.
    </p>
    
    <form method="get">
        <input type="hidden" name="pushed" value="is" />
        <input type="submit" id="btnSubmit" value="Continue" />
    </form>
</body>