<!DOCTYPE html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
    session_start();
    $fn = $_SESSION['filename'];
    if(isset($_POST['submit'])) {
        $age = $_POST['age'];
        $education = $_POST['education'];
        $Country = $_POST['Country'];
        $content = "PiechartGeographics,,,,,,,,$age,$education,$Country,$fn\n";
        
        $attentionChartType = $_POST['attentionChartType'];
        $attentionNoValues = $_POST['attentionNoValues'];
        if(!($attentionChartType==='Pie chart' && $attentionNoValues==6)){
            header('Location: ./../NoPayment.php');
        }
        
        $logFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($logFile, $content);
        fclose($logFile);
        
        echo("
            <h1>Thank you.</h1>
            <p>Thank you for participating in this study.</p>
            <p><strong> Your code for Crowdflower is: UbgrF5j3IOrMEU5</strong></p>");
        session_destroy();
    }
    else{
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
                <input type="text" name="education" required>
            </td>
        </tr>
        <tr>
            <td valign="top">
                Country:
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
                        <option value="Histogram">Histogram</option>
                        <option value="Flow chart">Flow chart</option>
                        <option value="Pie chart">Pie chart</option>
                        <option value="Line chart">Line chart</option>
                        <option value="Area chart">Area chart</option>
                        <option value="Bar chart">Bar chart</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                How many values were in each of the charts?
            </td>
            <td>
                <input type="text" name="attentionNoValues" maxlength="1" size="1" required>
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