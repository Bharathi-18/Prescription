<?php

session_start();

class phpTextToImage
{
    public $imageArray = [];
    public $imageNumber = 0;

    public function measureWidth($text, $fontSize = 14, $font = 'geoAi.ttf', $angle = 0, $imgWidth = 730)
    {
        $listOfImageText = [];
        $index = 0;
        $textLength = strlen($text);
        $modifiedText = "";

        $flag = 0;
        for ($i = 0; $i < $textLength; $i++) {
            $flag = 0;
            $modifiedText .= $text[$i];
            $textBox = imagettfbbox($fontSize, $angle, $font, $modifiedText);
            $textWidth = (($textBox[0] - $textBox[2]) * ($textBox[0] - $textBox[2])) + (($textBox[1] - $textBox[3]) * ($textBox[1] - $textBox[3])); // $width1 -> $textWidth
            $textWidth = round(sqrt($textWidth));
            if ($textWidth + 120 > $imgWidth - 20) {
                if ($text[$i] != ' ') {
                    $modifiedText[$i] = '-';
                    $listOfImageText[$index++] = $modifiedText;
                    $modifiedText = "";
                } else {
                    $modifiedText[$i] = ' ';
                    $modifiedText .= "\n";
                    $listOfImageText[$index++] = $modifiedText;
                    $modifiedText = "";
                }
                $i--;
                $flag = 1;
            }
        }
        if ($flag == 0)
            $listOfImageText[$index++] = $modifiedText;
        $modifiedText = "";
        for ($i = 0; $i < $index; $i++) {
            $modifiedText .= $listOfImageText[$i];
            $modifiedText .= '\n';
        }
        return $modifiedText;
    }

    function createImage($infoTextArray, $num, $fontSize = 18, $font = 'geoAi.ttf', $textColor = '', $backgroundColor = '', $imgWidth = 1750, $imgHeight = 400)
    {
        $font = 'font/' . $font;
        $this->imageArray[0] = imagecreatetruecolor($imgWidth, $imgHeight);
        if ($backgroundColor == '') {
            $backgroundColor = $this->hexToRGB("#fffdfa");
        } else {
            $backgroundColor = $this->hexToRGB($backgroundColor);
        }
        if ($textColor == '') {
            $textColor = $this->hexToRGB("#000000");
        } else {
            $textColor = $this->hexToRGB("#000000");
        }
        $textColor = imagecolorallocate($this->imageArray[0], $textColor['r'], $textColor['g'], $textColor['b']);
        $backgroundColor = imagecolorallocate($this->imageArray[0], $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);
        imagefilledrectangle($this->imageArray[0], 0, 0, $imgWidth - 1, $imgHeight - 1, $backgroundColor);
        //break lines
        $temporaryText = "";
        $updatedText = "";
        $imageObject = new phpTextToImage();
        for ($i = 0; $i < $num; $i++) {
            $temptext = $infoTextArray[$i]["Name"];
            $temptext .= "  :  ";
            $temptext1 = $infoTextArray[$i]["Input"];;

            $temporaryText .= $temptext;
            $temporaryText .= $temptext1;

            $temporaryText = $imageObject->measureWidth($temporaryText, $fontSize, $font);
            $temporaryText .= "\\n";

            $updatedText .= $temporaryText;
            $temporaryText = "";
        }
        $splitText = explode("\\n", $updatedText);
        $lines = count($splitText);
        $num = $lines;
        $angle = 0;
        $heading = "PRESCRIPTION";
        imagettftext($this->imageArray[0], 16, 90, 30, 210, $textColor, $font, $heading);
        $pr = 1;
        $x = 250;
        $y = 50;
        $count = 0;
        foreach ($splitText as $txt) {
            if (!empty($txt)) {
                $count = 1;
                $textBox = imagettfbbox($fontSize, $angle, $font, $txt);
                $height = (($textBox[0] - $textBox[6]) * ($textBox[0] - $textBox[6])) + (($textBox[1] - $textBox[7]) * ($textBox[1] - $textBox[7]));
                $height = round(sqrt($height));

                imagettftext($this->imageArray[$this->imageNumber], $fontSize, $angle, $x, $y, $textColor, $font, $txt);

                $y = $y + $height + 18;
                $num--;
                if ($y > $imgHeight - 20) {
                    if ($num >= 1 && $x == 900) {
                        $this->imageNumber++;
                        $this->imageArray[$this->imageNumber] = imagecreatetruecolor($imgWidth, $imgHeight);
                        imagettftext($this->imageArray[$this->imageNumber], 16, 90, 30, 210, $textColor, $font, $heading);
                        $x = 250;
                        $y = 50;
                        $count = 0;
                    } else if ($num >= 1) {
                        $x = 900;
                        $y = 50;
                    }
                }
            }
        }

        if ($x == 250) {

            $x = 900;
            $y = 50;
            $var = $imageObject->measureWidth("This page has no content", $fontSize, $font);
            $var = str_replace("\\n", "", $var);
            imagettftext($this->imageArray[$this->imageNumber], $fontSize, $angle, $x, $y, $textColor, $font, $var);
        }

        if ($count == 0) {
            $this->imageNumber--;
        }
        return true;
    }
    protected function hexToRGB($colour)
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return array('r' => $r, 'g' => $g, 'b' => $b);
    }

    public function saveAsPng($fileName = 'text-image', $location = 'image/')
    {
        $fileName = !empty($location) ? $location . $fileName : $fileName;
        $temp = $fileName;

        for ($i = 0; $i <= $this->imageNumber; $i++) {
            $fileName = $temp . "" . $i . ".png";
            imagepng($this->imageArray[$i], $fileName);
        }
    }
}

$img = new phpTextToImage();

$count = 0;

$imageFiles = scandir("image/");

foreach ($imageFiles as $if) {
    if (strpos($if, ".png") !== false) {
        unlink("image/" . $if);
    }
}

$ptname = $_GET["patientname"];
$medication = $_GET["medication"];
$instructions = $_GET["instructions"];
$quantity = $_GET["quantity"];
$filldate = $_GET["filldate"];
$expirationdate = $_GET["expirationdate"];
$refillsRemaining = $_GET["refillsRemaining"];
$rud = $_GET["rud"];
$prsnum = $_GET["prsnum"];
$wrng1 = $_GET["wrng1"];
$wrng2 = $_GET["wrng2"];
$wrng3 = $_GET["wrng3"];
$wrng4 = $_GET["wrng4"];
$wrng5 = $_GET["wrng5"];
// $font = $_POST["font"];
// $fontSize = $_POST["fontSize"];

$infoTextArray = []; // $array -> $infoTextArray

if ($ptname != "") {
    $infoTextArray[$count]["Name"] = "Patient Name";
    $infoTextArray[$count]["Input"] = $ptname;
    $count++;
}

if ($medication != "") {
    $infoTextArray[$count]["Name"] = "Medication";
    $infoTextArray[$count]["Input"] = $medication;
    $count++;
}

if ($instructions != "") {
    $infoTextArray[$count]["Name"] = "Instructions";
    $infoTextArray[$count]["Input"] = $instructions;
    $count++;
}
if ($quantity != "") {
    $infoTextArray[$count]["Name"] = "Quantity";
    $infoTextArray[$count]["Input"] = $quantity;
    $count++;
}
if ($filldate != "") {
    $infoTextArray[$count]["Name"] = "Fill date";
    $infoTextArray[$count]["Input"] = $filldate;
    $count++;
}
if ($expirationdate != "") {
    $infoTextArray[$count]["Name"] = "Expiration date";
    $infoTextArray[$count]["Input"] = $expirationdate;
    $count++;
}
if ($refillsRemaining != "") {
    $infoTextArray[$count]["Name"] = "Refills Remaining";
    $infoTextArray[$count]["Input"] = $refillsRemaining;
    $count++;
}
if ($rud != "") {
    $infoTextArray[$count]["Name"] = "Refillable until date";
    $infoTextArray[$count]["Input"] = $rud;
    $count++;
}
if ($prsnum != "") {
    $infoTextArray[$count]["Name"] = "Prescription Number";
    $infoTextArray[$count]["Input"] = $prsnum;
    $count++;
}
if ($wrng1 != "") {
    $infoTextArray[$count]["Name"] = "Warning 1";
    $infoTextArray[$count]["Input"] = $wrng1;
    $count++;
}
if ($wrng2 != "") {
    $infoTextArray[$count]["Name"] = "Warning 2";
    $infoTextArray[$count]["Input"] = $wrng2;
    $count++;
}
if ($wrng3 != "") {
    $infoTextArray[$count]["Name"] = "Warning 3";
    $infoTextArray[$count]["Input"] = $wrng3;
    $count++;
}
if ($wrng4 != "") {
    $infoTextArray[$count]["Name"] = "Warning 4";
    $infoTextArray[$count]["Input"] = $wrng4;
    $count++;
}
if ($wrng5 != "") {
    $infoTextArray[$count]["Name"] = "warning 5";
    $infoTextArray[$count]["Input"] = $wrng5;
    $count++;
}


$fontSize = 16;
$font = 'Gotham Bold.ttf';

$img->createImage($infoTextArray, $count, $fontSize, $font);
$fileName = "prescription";
$img->saveAsPng($fileName);

$infoTextArray[$count]["Name"] = "font";
$infoTextArray[$count]["Input"] = $font;

$count++;

$infoTextArray[$count]["Name"] = "fontsize";
$infoTextArray[$count]["Input"] = $fontSize;

$count++;

$textColor = "#000000";
$backgroundColor = "#fffdfa";


$infoTextArray[$count]["Name"] = "textColor";
$infoTextArray[$count]["Input"] = $textColor;

$count++;

$infoTextArray[$count]["Name"] = "backgroundColor";
$infoTextArray[$count]["Input"] = $backgroundColor;

$jsonString = json_encode($infoTextArray, JSON_PRETTY_PRINT);

$fp = fopen('JSON/db.json', 'w');
fwrite($fp, $jsonString);
fclose($fp);
$arrFiles = scandir("image/");
$_SESSION["resultantArray"] = [];
$index = 0;

foreach ($arrFiles as $af) {
    if (strpos($af, ".png") !== false) {
        $_SESSION["resultantArray"][$index++] = $af;
    }
}

$fontNameArray = [];
$fontIndex = 0;
$fontArray = scandir("font/");
foreach ($fontArray as $fA) {
    if (strpos($fA, ".ttf") !== false) {
        if ($fA === $font) {
            $fontNameArray[$fontSizeIndex]["fontName"] = str_replace(".ttf", "", $fA);
            $fontNameArray[$fontSizeIndex]["font"] = $fA;
            $fontNameArray[$fontSizeIndex]["selected"] = "1";
        } else {
            $fontNameArray[$fontSizeIndex]["fontName"] = str_replace(".ttf", "", $fA);
            $fontNameArray[$fontSizeIndex]["font"] = $fA;
            $fontNameArray[$fontSizeIndex]["selected"] = "0";
        }
        $fontSizeIndex++;
    }
}

$jsonString = json_encode($fontNameArray, JSON_PRETTY_PRINT);

$fontJSON = fopen("JSON/font.json", 'w');
fwrite($fontJSON, $jsonString);
fclose($fontJSON);

$fontSizeArray = [];
$fontIndex = 0;
for ($i = 12; $i <= 22;) {
    if ($i + 4 === $fontSize) {
        $fontSizeArray[$fontSizeIndex]["dispfontSize"] = "" . $i;
        $fontSizeArray[$fontSizeIndex]["fontSize"] = "" . ($i + 4);
        $fontSizeArray[$fontSizeIndex]["selected"] = "1";
    } else {
        $fontSizeArray[$fontSizeIndex]["dispfontSize"] = "" . $i;
        $fontSizeArray[$fontSizeIndex]["fontSize"] = "" . ($i + 4);
        $fontSizeArray[$fontSizeIndex]["selected"] = "0";
    }
    $fontSizeIndex++;
    $i += 2;
}

$jsonString = json_encode($fontSizeArray, JSON_PRETTY_PRINT);

$fontJSON = fopen("JSON/fontSize.json", 'w');
fwrite($fontJSON, $jsonString);
fclose($fontJSON);


header("location:displayImage.php");
