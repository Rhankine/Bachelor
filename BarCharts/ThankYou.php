<?php
    session_start();
    $fn = $_SESSION['filename'];
    if(isset($_POST['submit'])) {
        $age = $_POST['age'];
        $education = $_POST['education'];
        $Country = $_POST['Country'];
        $attentionChartType = $_POST['attentionChartType'];
        $content = "BarChartGeographics,,,,,,,,,,,$age,$education,$Country,$fn,,,$attentionChartType\n";
        if(!($attentionChartType==='Bar chart')){
            header('Location: ./../NoPayment.php');
        }
        
        $logFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($logFile, $content);
        fclose($logFile);
        
        echo('<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./barchart.css">
        <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
    </head>
    <body>
    '); 
        echo("
            <h1>Thank you.</h1>
            <p>Thank you for participating in this study.</p>
            <p><strong> Your code for Crowdflower is: UbgrF5j3IOrMEU5</strong><br />
            You need to copy this code, and insert it into the form in Crowdflower to get paid.</p>");
        session_destroy();
    }
    else{
        echo('<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./barchart.css">
        <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
    </head>
    <body>
    ');
        echo('
            <h3>About you</h3>
<p>
    Please fill in the following information about you.
</p>
<form action="" method="post">
    <table cellpadding="10">
        <tr>
            <td valign="top">
                Age:
            </td>
            <td>
                <select name="age" required>
                    <option value="Under 20">Under 20</option>
                    <option value="20-29">20-29</option>
                    <option value="30-39">30-39</option>
                    <option value="40-49">40-49</option>
                    <option value="50-59">50-59</option>
                    <option value="60+">60+</option>
                </select>
            </td>
        </tr>
        <tr>
            <td valign="top">
                Education level:
            </td>
            <td>
                <select name="education" required>
                    <option value="High school degree or less">High school degree or less</option>
                    <option value="Some college">Some college</option>
                    <option value="College degree">College degree</option>
                    <option value="Post-grad degree">Post-grad degree</option>
                </select>
            </td>
        </tr>
        <tr>
            <td valign="top">
                Country of residence:
            </td>
            <td>
                <input type="text" name="Country" required>
            </td>
        </tr>
        <tr>
            <td valign="top">
                Is english your native language?:
            </td>
            <td>
                <select name="english" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Which chart type did you see?
            </td>
            <td>
                <select name="attentionChartType" required>
                        <option value="Flow chart">Flow chart</option>
                        <option value="Pie chart">Pie chart</option>
                        <option value="Line chart">Line chart</option>
                        <option value="Area chart">Area chart</option>
                        <option value="Bar chart">Bar chart</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Submit">
            </td>
        </tr>
    </table>
</form>
        ');
    }
?>

</body>