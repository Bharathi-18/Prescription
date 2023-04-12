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

    <style>
        * {
            margin: 0;
        }

        body {
            background-color: rgb(161, 226, 120);
        }

        nav {
            background-color: rgb(31, 30, 30);
        }

        header {
            margin-left: 44%;
            font-family: 'Roboto Slab';
            padding-top: 30px;
            padding-bottom: 18px;
            color: rgb(184, 226, 185);
            font-size: 22px;
        }

        header button {
            margin-left: 70%;
            font-size: 18px;
            border-radius: 8px;
            border-style: none;
            background-color: black;
            color: aliceblue;
            width: 80px;
            height: 32px;
        }

        header button:hover {
            background-color: aliceblue;
            color: black;
        }

        .parameters {
            display: flex;
            position: relative;
            font-family: 'Sofia Sans Condensed';
            font-size: 20px;
            margin-left: 26%;
            margin-top: 5%;
        }

        .parameters .secondhalf {
            margin-top: -62%;
            margin-left: 130%;
            width: 100%;
        }

        .parameters .generate {
            margin-top: 10%;
            margin-left: 85%;
        }

        input[type="submit"] {
            border-radius: 25px;
            height: 30px;
            width: 180px;
            border-style: none;
            background-color: black;
            color: white;
        }

        .btn {
            width: 150px;
            height: 30px;
            margin-top: 25%;
            display: block;
        }

        .imgclass {
            width: fit-content;
            height: fit-content;
            margin-top: 32%;
            margin-left: -35%;
        }

        #imgCls {
            margin-top: 38%;
            padding-bottom: 20%;
            margin-left: -25%;
        }

        .imgCr {
            margin-top: 36%;
            margin-left: -45%;
            display: block;
            padding: 100px;
        }

        .rstBtn {
            display: none;
        }

        .container {
            margin-top: 60%;
        }

        .mySlides {
            display: none
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            margin-top: 60%;
            margin-left: 8%;
            max-width: 1400px;
            max-height: fit-content;
            position: relative;
            margin: auto;
            padding-top: 20px;
        }

        /* Next & previous buttons */

        .prev {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: fit-content;
            padding: 5px;
            margin-top: 18px;
            margin-left: -3%;
            color: black;
            font-weight: bold;
            font-size: 28px;
            transition: 0s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: fit-content;
            padding: 5px;
            margin-top: 18px;
            margin-right: -3.2%;
            color: black;
            font-weight: bold;
            font-size: 28px;
            transition: 0s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }


        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
        }

        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        .numbertext {
            color: black;
            font-size: 18px;
            padding: 8px 12px;
            position: absolute;
            top: 70px;
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 0.4s;
        }


        .postForm {
            /* visibility: hidden; */
            display: none;
        }

        .getForm {
            display: none;
        }

        .format td {
            padding-left: 30px;
            font-size: 18px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }


        .print {
            margin-left: 45%;
            /* margin-top: -20%; */
            padding-bottom: 100px;
        }

        @media only screen and (max-width: 300px) {

            .prev,
            .next,
            .text {
                font-size: 11px
            }
        }

        @media only screen and (max-width: 1022px) {
            .parameters .secondhalf {
                margin-top: 2%;
                margin-left: 0%;
            }

            .parameters .generate {
                margin-left: 20%;
            }
        }

        @media only screen and (max-width: 518px) {
            nav header {
                margin-left: 15%;
            }

            .parameters {
                margin-left: 10%;
            }
        }

        @media only screen and (max-width: 473px) {
            nav header {
                margin-left: 20%;
            }

            .parameters {
                margin-left: 10%;
            }
        }

        @media only screen and (max-width: 385px) {
            nav header {
                margin-left: 15%;
            }

            .parameters {
                margin-left: 10%;
            }
        }

        @media only screen and (max-width: 357px) {
            nav header {
                margin-left: 11%;
            }

            .parameters {
                margin-left: 4%;
            }
        }
    </style>

</head>

<body>

    <nav>
        <header>
            <h1> Prescription</h1>
            <button onclick="clears()">Clear</button>
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
    <div class="slideshow-container">

        <?php
        if (!empty($_SESSION['resultantArray'])) {

            echo "<table class=\"format\">
                <tr>
                    <td>
                        <label for=\"font\">Font:</label>
                        <select name=\"font\" id=\"font\" onchange = \"fontStyle()\">
                            <option value=\"\">-- Choose Font --</option>
                            <option value=\"geoAi.ttf\">GeoAI</option>
                            <option value=\"timesnewroman.ttf\">Times New Roman</option>
                            <option value=\"GothamBold.ttf\">Gotham Bold</option>
                            <option value=\"HelveticaBlack.ttf\">Helvetica Black</option>
                            <option value=\"HelveticaBold.ttf\">Helvetica Bold</option>
                            <option value=\"Tahoma.ttf\">Tahoma</option>
                            <option value=\"Verdana.ttf\">Verdana</option>
                        </select>
                    </td>
                    <td>
                        <label for=\"fontSize\">Font Size:</label>
                        <select name=\"fontSize\" id=\"fontSize\" onchange = \"fontSize()\">
                            <option value=\"\">-- Choose Font Size --</option>
                            <option value=\"14\">12</option>
                            <option value=\"16\">14</option>
                            <option value=\"18\">16</option>
                            <option value=\"20\">18</option>
                            <option value=\"22\">20</option>
                            <option value=\"24\">22</option>
                        </select>
                    </td>
                    <td>
                        <button onclick=\"invert()\" id=\"invertBtn\">Invert</button>
                    </td>
            </table><br><br><br><br>";

            $numberOfGeneratedImages = 0;

            foreach ($_SESSION["resultantArray"] as $generatedImage) {
                $numberOfGeneratedImages++;
            }

            $indexOfImage = 1;
            foreach ($_SESSION["resultantArray"] as $generatedImage) {

                echo "<div class=\"mySlides\"><div class=\"numbertext\">" . $indexOfImage++ . "/" . $numberOfGeneratedImages . "</div><img src=\"image/$generatedImage\" style=\"width:100%\"></div>";
            }
            echo "<a class=\"prev\" onclick=\"plusSlides(-1)\">❮</a><a class=\"next\" onclick=\"plusSlides(1)\">❯</a></div><br>";

            $indexOfImage = 1;

            echo "<div class=\"print\"><form action=\"printImage.php\"><input type=\"submit\" value=\"Download ZPL\"><form></div>";
        }
        ?>
    </div>

</body>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    const select = document.getElementById('font');

    select.addEventListener('change', function handleChange(event) {
        console.log(event.target.value);
    });

    function invert() {
        window.location = "formatImage.php?var=1,,";
    }

    function fontStyle() {
        const select = document.getElementById('font').value;
        window.location = "formatImage.php?var=0," + select + ",0";
    }

    function fontSize() {
        const select = document.getElementById('fontSize').value;
        window.location = "formatImage.php?var=0,0," + select;
    }

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