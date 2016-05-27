<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./BarChart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>

<?php
    session_start();
    $fn = $_SESSION['filename'];
    $did = 1;
    if(isset($_POST['submit'])) {
        $method = $_POST['method'];
        $content = "BarchartFilterMethod, $method, \n";
        
        $BarFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($BarFile, $content);
        fclose($BarFile);
        $studyno = $_SESSION['studyno'];
        switch ($studyno) {
            case '0':
                header('Location: ./FrontpageBarReorder.php');
                break;
            case '1':
                header('Location: ./FrontpageBarBase.php');
                break;
            case '2':
                header('Location: ./FrontpageBarBase.php');
                break;
            case '3':
                header('Location: ./../ThankYou.php');
                break;
            case '4':
                header('Location: ./FrontpageBarReorder.php');
                break;
            case '5':
                header('Location: ./../ThankYou.php');
                break;
        }
    }
    echo("<input type='hidden' value='".$did."' id='h_v' class='h_v'>");
?>
    
    
<script src="./BarChartFilter.js"></script>
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