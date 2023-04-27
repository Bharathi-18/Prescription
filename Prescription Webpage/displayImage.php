<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Sofia Sans Condensed' rel='stylesheet'>
    <title>Display Image</title>
    <style>
        * {
            margin: 0;
        }

        body {
            background-color: rgb(161, 226, 120);
        }

        nav {
            background-color: black;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            margin-left: 45%;
            font-family: 'Roboto Slab';
            padding-top: 30px;
            padding-bottom: 18px;
            color: rgb(184, 226, 185);
            font-size: 22px;
        }

        header button {
            margin-top: 1%;
            margin-left: 50%;
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
            display: flex;
            flex-direction: row;
            margin-left: 35%;
            /* margin-top: -20%; */
            padding-bottom: 100px;
        }

        .print form {
            padding-left: 50px;

        }

        .displayzpl {
            /* visibility: hidden; */
            display: none;
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
            <button class="homeBtn" onclick="navigateToHome()">Home</button>

        </header>
    </nav>

    <div class="slideshow-container">

        <?php
        if (!empty($_SESSION['resultantArray'])) {

            echo "<table class=\"format\">
                <tr>
                    <td>
                        <label for=\"font\">Font:</label>
                        <select name=\"font\" id=\"font\" onchange = \"fontStyle()\"> ";

            // echo " <option value=\"geoAi.ttf\">GeoAI</option>
            //                 <option value=\"timesnewroman.ttf\">Times New Roman</option>
            //                 <option value=\"GothamBold.ttf\">Gotham Bold</option>
            //                 <option value=\"HelveticaBlack.ttf\">Helvetica Black</option>
            //                 <option value=\"HelveticaBold.ttf\">Helvetica Bold</option>
            //                 <option value=\"Tahoma.ttf\">Tahoma</option>
            //                 <option value=\"Verdana.ttf\">Verdana</option>";


            $path = 'JSON/font.json';
            $jsonString = file_get_contents($path);
            $jsondata = json_decode($jsonString, true);

            $count = 0;
            foreach ($jsondata as $jd) {
                if ($jd["selected"] === "1") {
                    echo "<option value=\"" . $jd["font"] . "\" selected>" . $jd["fontName"] . "</option>";
                } else {
                    echo "<option value=\"" . $jd["font"] . "\" >" . $jd["fontName"] . "</option>";
                }
            }

            echo "/select>
                    </td>
                    <td>
                        <label for=\"fontSize\">Font Size:</label>
                        <select name=\"fontSize\" id=\"fontSize\" onchange = \"fontSize()\">";

            $path = 'JSON/fontSize.json';
            $jsonString = file_get_contents($path);
            $jsondata = json_decode($jsonString, true);

            $count = 0;
            foreach ($jsondata as $jd) {
                if ($jd["selected"] === "1") {
                    echo "<option value=\"" . $jd["fontSize"] . "\" selected>" . $jd["dispfontSize"] . "</option>";
                } else {
                    echo "<option value=\"" . $jd["fontSize"] . "\">" . $jd["dispfontSize"] . "</option>";
                }
            }


            echo "</select>
                    </td><td>";

            $path = 'JSON/db.json';
            $jsonString = file_get_contents($path);
            $jsondata = json_decode($jsonString, true);

            $flag = 0;
            foreach ($jsondata as $jd) {
                if ($jd["Name"] == "backgroundColor") {
                    if ($jd["Input"] == "#000000") {
                        $flag = 1;
                    }
                    break;
                }
            }

            if ($flag == 1)
                echo "<input type=\"checkbox\" value=\"Invert\" onclick=\"invert()\" checked> &nbsp;Invert";
            else
                echo "<input type=\"checkbox\" value=\"Invert\" onclick=\"invert()\"> &nbsp;Invert";


            echo "</td>
                    <td>
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

            echo "<div class=\"print\"><input type=\"submit\" value=\"Generate ZPL\" onclick=\"disp()\"><form action=\"printImage.php\"><input type=\"submit\" value=\"Download ZPL\"><form></div>";
        }
        ?>
    </div>
    <div class="displayzpl" id="displayzpl">
        <iframe src="displayZPL.php" width="98%" height="610px"></iframe>
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

    function disp() {
        document.getElementById("displayzpl").style.display = "block";
    }

    function navigateToHome() {
        window.location = "index.php";
    }
</script>

</html>