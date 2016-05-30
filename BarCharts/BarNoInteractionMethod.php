<?php
    session_start();
    $fn = $_SESSION['filename'];
    $did = 1;
    if(isset($_POST['submit'])) {
        $extend = $_POST['extend'];
        $strategy = $_POST['strategy'];
        $liked = $_POST['liked'];
        $improvement = $_POST['improvement'];
        $comments = $_POST['comments'];
        $content = "BarchartNoInteractionMethod,,,$extend,$strategy,$liked,$improvement,$comments,,,,$fn\n";
        
        $BarFile = fopen($fn, 'a') or die("Unable to open file");
        fwrite($BarFile, $content);
        fclose($BarFile);
        $studyno = $_SESSION['studyno'];
        switch ($studyno) {
            case '0':
                header('Location: ./FrontpageBarBase.php');
                break;
            case '1':
                header('Location: ./FrontpageBarFilter.php');
                break;
            case '2':
                header('Location: ./FrontpageBarBase.php');
                break;
            case '3':
                header('Location: ./ThankYou.php');
                break;
        }
    }
    echo('<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./barchart.css">
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
</head>
<body>
');
    echo("<input type='hidden' value='".$did."' id='h_v' class='h_v'>");
?>
    
    
<script src="./BarChartNoInteraction.js"></script>
<br /><br /><br /><br />

<form action='' method='post'>
    <table cellpadding="10">
        <tr>
            <td valign="top">
                To what extend did you use the interaction?
            </td>
            <td>
                <input type="radio" name="extend" value="Always" required>Always<br />
                <input type="radio" name="extend" value="Most of the time">Most of the time<br />
                <input type="radio" name="extend" value="Sometimes">Sometimes<br />
                <input type="radio" name="extend" value="Rarely">Rarely<br />
                <input type="radio" name="extend" value="Never">Never<br />
            </td>
        </tr>
        <tr>
            <td valign="top">
                Please descripe how you solved the tasks.
            </td>
            <td>
                <textarea name="strategy" rows="5" cols="30" required></textarea>
            </td>
        </tr>
        <tr>
            <td valign="top">
                How did you like this interaction?
            </td>
            <td>
                <textarea name="liked" rows="5" cols="30" required></textarea>
            </td>
        </tr>
        <tr>
            <td valign="top">
                How could the interaction be improved?
            </td>
            <td>
                <textarea name="improvement" rows="5" cols="30" required></textarea>
            </td>
        </tr>
        <tr>
            <td valign="top">
                Do you have any comments?
            </td>
            <td>
                <textarea name="comments" rows="5" cols="30"></textarea>
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