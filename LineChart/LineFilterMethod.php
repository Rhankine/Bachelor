<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="LineChart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>

<?php
    session_start();
    $fn = $_SESSION['filename'];
    $did = 1;
    if(isset($_POST['submit'])) {
        $method = $_POST['method'];
        $content = "LinechartFilterMethod, $method, \n";
        
        $BarFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($BarFile, $content);
        fclose($BarFile);
        $studyno = $_SESSION['studyno'];
        if($studyno = '0'){
            header('Location: /LineChart/FrontpageLineBase.php');            
        }
        else {
            header('Location: /ThankYou.html');
        }
    }
    echo("<input type='hidden' value='".$did."' id='h_v' class='h_v'>");
?>
    
    
<script src="LineChartFilter.js"></script>
<br /><br /><br /><br />

<form action='' method='post'>
    <table cellpadding="10">
        <tr>
            <td valign="top">
                How did you perform, your judgement of the chart?
            </td>
            <td>
                <textarea name="method" rows="10" cols="30" required></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type='submit' name='submit' value='Submit'>
            </td>
        </tr>
    </table>
</form>
</body>