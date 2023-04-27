<?php
session_start();
if (empty($_SESSION["resultantArray"])) {
    $generatedImageFilesArray = scandir("image/");
    foreach ($generatedImageFilesArray as $gifa) {
        if (strpos($gifa, ".png") !== false) {
            unlink("image/" . $gifa);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Sofia Sans Condensed' rel='stylesheet'>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <nav>
        <header>
            <h1> Prescription</h1>
        </header>
    </nav>

    <div class="methodChoose" style="margin-left: 46%;margin-top:5%;">
        <label for="mthd">METHOD</label>
        <select name="mthd" id="mthd" onchange="chooseMeth()">
            <option value="">--Choose method--</option>
            <option value="GET">GET</option>
            <option value="POST">POST</option>
        </select>
    </div>

    <div class="parameters">
        <div class="getForm" id="getForm">
            <form method="GET" action="createImageFromTextGet.php" id="prsfrm">
                <br><br>
                <table class="firsthalf">
                    <tr>
                        <td>Patient Name</td>
                        <td><input type="text" name="patientname" id="patientname"></td>
                    </tr>
                    <tr>
                        <td>Medication</td>
                        <td><input type="text" name="medication" id="medication"></td>
                    </tr>
                    <tr>
                        <td>Instructions</td>
                        <td><input type="text" name="instructions" id="instructions"></td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td><input type="text" name="quantity" id="quantity"></td>
                    </tr>
                    <tr>
                        <td>Fill Date</td>
                        <td><input type="date" name="filldate" id="filldate"></td>
                    </tr>
                    <tr>
                        <td>Expiration Date</td>
                        <td><input type="date" name="expirationdate" id="expirationdate"></td>
                    </tr>
                    <tr>
                        <td>Refills Remaining &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="text" name="refillsRemaining" id="refillsRemaining"></td>
                    </tr>
                </table>
                <table class="secondhalf">
                    <tr>
                        <td>Refillable until date</td>
                        <td><input type="date" name="rud" id="rud"></td>
                    </tr>
                    <tr>
                        <td>Prescription number</td>
                        <td><input type="text" name="prsnum" id="prsnum"></td>
                    </tr>
                    <tr>
                        <td>Warning 1</td>
                        <td><input type="text" name="wrng1" id="wrng1"></td>
                    </tr>
                    <tr>
                        <td>Warning 2</td>
                        <td><input type="text" name="wrng2" id="wrng2"></td>
                    </tr>
                    <tr>
                        <td>Warning 3</td>
                        <td><input type="text" name="wrng3" id="wrng3"></td>
                    </tr>
                    <tr>
                        <td>Warning 4</td>
                        <td><input type="text" name="wrng4" id="wrng4"></td>
                    </tr>
                    <tr>
                        <td>Warning 5</td>
                        <td><input type="text" name="wrng5" id="wrng5"></td>
                    </tr>
                </table>
                <table class="generate">
                    <tr>
                        <td><input type="submit" value="Generate Image"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
            <br><br><br> <br>
        </div>
        <div class="postForm" id="postForm">
            <form method="POST" action="createImageFromText.php" id="prsfrm">
                <br><br>
                <table class="firsthalf">
                    <tr>
                        <td>Patient Name</td>
                        <td><input type="text" name="patientname" id="patientname"></td>
                    </tr>
                    <tr>
                        <td>Medication</td>
                        <td><input type="text" name="medication" id="medication"></td>
                    </tr>
                    <tr>
                        <td>Instructions</td>
                        <td><input type="text" name="instructions" id="instructions"></td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td><input type="text" name="quantity" id="quantity"></td>
                    </tr>
                    <tr>
                        <td>Fill Date</td>
                        <td><input type="date" name="filldate" id="filldate"></td>
                    </tr>
                    <tr>
                        <td>Expiration Date</td>
                        <td><input type="date" name="expirationdate" id="expirationdate"></td>
                    </tr>
                    <tr>
                        <td>Refills Remaining &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="text" name="refillsRemaining" id="refillsRemaining"></td>
                    </tr>
                </table>
                <table class="secondhalf">
                    <tr>
                        <td>Refillable until date</td>
                        <td><input type="date" name="rud" id="rud"></td>
                    </tr>
                    <tr>
                        <td>Prescription number</td>
                        <td><input type="text" name="prsnum" id="prsnum"></td>
                    </tr>
                    <tr>
                        <td>Warning 1</td>
                        <td><input type="text" name="wrng1" id="wrng1"></td>
                    </tr>
                    <tr>
                        <td>Warning 2</td>
                        <td><input type="text" name="wrng2" id="wrng2"></td>
                    </tr>
                    <tr>
                        <td>Warning 3</td>
                        <td><input type="text" name="wrng3" id="wrng3"></td>
                    </tr>
                    <tr>
                        <td>Warning 4</td>
                        <td><input type="text" name="wrng4" id="wrng4"></td>
                    </tr>
                    <tr>
                        <td>Warning 5</td>
                        <td><input type="text" name="wrng5" id="wrng5"></td>
                    </tr>
                </table>
                <table class="generate">
                    <tr>
                        <td><input type="submit" value="Generate Image"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
            <br><br><br> <br>
        </div>
    </div>
</body>

<script>
    function chooseMeth() {

        var meth = document.getElementById("mthd").value;
        console.log(meth);
        if (meth === "GET") {
            document.getElementById("getForm").style.display = "flex";
            document.getElementById("postForm").style.display = "none";
        }
        if (meth === "POST") {
            document.getElementById("postForm").style.display = "flex";
            document.getElementById("getForm").style.display = "none";
        }

    }
</script>

</html>