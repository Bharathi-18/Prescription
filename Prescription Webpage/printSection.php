<?php

session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background-color: cadetblue;
        }

        form {
            margin-top: 5%;
        }

        table {
            padding-left: 180px;
        }

        table td {
            margin-left: 5%;
            padding-left: 60px;
            font-size: 23px;
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
            margin-left: -25%;
            max-width: 1000px;
            position: relative;
            margin: auto;
            padding: 50px;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: fit-content;
            padding: 16px;
            margin-top: -22px;
            margin-left: -5%;
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
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
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

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
    </style>

</head>

<body>
    <div class="">
        <form action="">
            <table class="format">
                <tr>
                    <td>
                        <label for="font">Font:</label>
                        <select onchange="font()" name="font" id="font">
                            <option value="geoAi.ttf">GeoAI</option>
                            <option value="timesnewroman.ttf">Times New Roman</option>
                        </select>
                    </td>
                    <td>
                        <label for="fontSize">Font Size:</label>
                        <select onchange="fontSize()" name="fontSize" id="fontSize">
                            <option value="10">10</option>
                            <option value="12">12</option>
                            <option value="14">14</option>
                            <option value="16">16</option>
                            <option value="18">18</option>
                            <option value="20">20</option>
                        </select>
                    </td>
                    <td>
                        <input type="button" value="Invert" onclick="invertImage()">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <br><br>

    <div class="slideshow-container">

        <?php
        if (!empty($_SESSION['resultantArray'])) {
            // echo "<ol class=\"carousel-indicators\">";
            $n = 0;

            foreach ($_SESSION["resultantArray"] as $af) {
                $n++;
            }

            $i = 1;
            foreach ($_SESSION["resultantArray"] as $af) {

                echo "<div class=\"mySlides\"><div class=\"numbertext\">" . $i++ . "/" . $n . "</div><img src=\"image/$af\" style=\"width:100%\"></div>";
            }
            echo "<a class=\"prev\" onclick=\"plusSlides(-1)\">❮</a><a class=\"next\" onclick=\"plusSlides(1)\">❯</a></div><br>";

            $i = 1;
        }
        ?>
    </div>

</body>

<script>
    function invertImage() {
        window.location = "printImage.php?var=1,,";
    }

    function font() {
        var font = document.getElementById("font").value;
        window.location = "printImage.php?var=0," + font + ",";
    }

    function fontSize() {
        var fontSize = document.getElementById("fontSize").value;
        window.location = "printImage.php?var=0,," + fontSize;
    }
</script>

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
</script>

</html>