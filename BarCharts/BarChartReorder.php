<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./barchart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>

<?php
    session_start();
    $fn = $_SESSION['filename'];
    $did = $_SESSION['did'];
    $date = new DateTime();
    $studyno = $_SESSION['studyno']; 
    if(isset($_POST['submit'])) {
        $department = $_POST['Department'];
        $sizeOf = $_POST['sizeOf'];
        $timestart = $_POST['timestart'];
        $timeend = $date->format("H:i:s");
        $content = "barchartReorder$did, $department, $sizeOf,,,,,,,,,$fn,$timestart,$timeend\n";
        $date = new DateTime();
        
        $BarFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($BarFile, $content);
        fclose($BarFile);
        }
    $_SESSION['did'] += 1;
    $did = $_SESSION['did'];
    if($did > 15){
        header('Location: ./BarReorderMethod.php');
    }
    echo("<input type='hidden' value='".$did."' id='h_v' class='h_v'>");
?>
    
    
<script src="./BarChartReorder.js"></script>
<br /><br /><br /><br />

<form action='' method='post'>
    <table cellpadding="10">
        <tr>
            <td valign="top">
                Which datapoint is smaller?
            </td>
            <td>
                <input type="radio" name="Department" value="Group" required> Group<br />
                <input type="radio" name="Department" value="Legal"> Legal
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
                <?php
                    $date = new DateTime();
                    $now = $date->format("H:i:s");
                    echo("<input type='hidden' value='$now' name='timestart'>");
                ?>
                <input type='submit' name='submit' value='Submit'>
            </td>
        </tr>
    </table>
</form>
</body>