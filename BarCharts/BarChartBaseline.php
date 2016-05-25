<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="barchart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>

<?php
    session_start();
    $fn = $_SESSION['filename'];
    $did = $_SESSION['did'];
    $studyno = $_SESSION['studyno']; 
    if(isset($_POST['submit'])) {
        $department = $_POST['Department'];
        $sizeOf = $_POST['sizeOf'];
        $content = "barchartBaseline$did, $department, $sizeOf\n";
        $date = new DateTime();
        
        $BarFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($BarFile, $content);
        fclose($BarFile);
        }
    $_SESSION['did'] += 1;
    $did = $_SESSION['did'];
    if($did > 15){
        switch ($studyno) {
            case '0':
                header('Location: /ThankYou.html');
                break;
            case '1':
                header('Location: /BarCharts/FrontpageBarReorder.php');
                break;
            case '2':
                header('Location: /ThankYou.html');
                break;
            case '3':
                header('Location: /BarCharts/FrontpageBarFilter.php');
                break;
            case '4':
                header('Location: /BarCharts/FrontpageBarFilter.php');
                break;
            case '5':
                header('Location: /BarCharts/FrontpageBarReorder.php');
                break;
        }
    }
    echo("<input type='hidden' value='".$did."' id='h_v' class='h_v'>");
?>
    
    
<script src="BarChartBaseline.js"></script>
<br /><br /><br /><br />

<form action='' method='post'>
    <table cellpadding="10">
        <tr>
            <td valign="top">
                Which datapoint is smaller?
            </td>
            <td>
                <input type="radio" name="Department" value="Jan" required> Jan<br />
                <input type="radio" name="Department" value="Apr"> Apr
            </td>
        </tr>
        <tr>
            <td>
                How many percent is the smaller in size of the bigger?
            </td>
            <td>
                <input type="text" name="sizeOf"maxlength="3" size="3" required>%
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