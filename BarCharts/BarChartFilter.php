<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="barchart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>
<script src="BarChartFilter.js"></script>
<br /><br /><br /><br />

<?php
    session_start();
    $fn = $_SESSION['filename'];
    if(isset($_POST['submit'])) {
        $department = $_POST['Department'];
        $sizeOf = $_POST['sizeOf'];
        $content = "$department, $sizeOf\n";
        $date = new DateTime();
        $filename = "Bar".$date->getTimestamp().".csv";
        
        $BarFile = fopen($filename, 'a') or die("Unable to open file");
        fwrite($BarFile, $content);
        fclose($BarFile);
        }
?>

<form action='' method='post'>
    <table cellpadding="10">
        <tr>
            <td valign="top">
                Which datapoint is smaller?
            </td>
            <td>
                <input type="radio" name="Department" value="PAX"> PAX<br />
                <input type="radio" name="Department" value="Procurement"> Procurement
            </td>
        </tr>
        <tr>
            <td>
                How many percent is the smaller in size of the bigger?
            </td>
            <td>
                <input type="text" name="sizeOf"maxlength="3" size="3">%
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