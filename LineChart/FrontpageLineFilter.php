<?php
    session_start();
    if(isset($_GET['pushed'])){
        $date = new DateTime();
        $_SESSION['did'] = 0;
        header('Location: ./LineChartFilter.php');    
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./LineChart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <title>Filter</title>
</head>
<body>
    <h1>Filtering</h1>
    <p>
        In the next 15 tasks, you will be presented with a line chart, like the one bellow. This line chart has the interaction type filtering.<br />
        This means that you can click on any point in the line chart and make that point disappear. You can try on the chart below<br />
        If you regret filtering the data, you can press the reset button, in the button of the chart.<br />
    </p>
    <p>
        It is your choice if you want to use the interaction or not.
    </p>
        <input type='hidden' value='test' id='h_v' class='h_v'>
        <script src="./LineChartFilter.js"></script>
        <form action="./FrontpageLineFilter.php" method="post">
            <input type="submit" value="Reset">
        </form>
    <p>
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
    <p>
        Please click continue when you are ready to start the tasks.
    </p>
    
    <form method="get">
        <input type="hidden" name="pushed" value="is" />
        <input type="submit" id="btnSubmit" value="Continue" />
    </form>
</body>