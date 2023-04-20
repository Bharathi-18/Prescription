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
        if ($backgroundColor == '#000000') {
            $backgroundColor = $this->hexToRGB("#000000");
        } else {
            $backgroundColor = $this->hexToRGB("#fffdfa");
        }
        if ($textColor == '#fffdfa') {
            $textColor = $this->hexToRGB("#fffdfa");
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
    if (strpos($if, ".png")) {
        unlink("image/" . $if);
    }
}

$infoTextArray = [];

$path = 'JSON/db.json';
$jsonString = file_get_contents($path);
$jsondata = json_decode($jsonString, true);

$count = 0;
foreach ($jsondata as $jd) {
    if ($jd["Name"] === "font") {
        break;
    } else {
        $infoTextArray[$count]["Name"] = $jd["Name"];
        $infoTextArray[$count]["Input"] = $jd["Input"];
    }
    $count++;
}

$font = $jsondata[$count]["Input"];
$fontSize = $jsondata[$count + 1]["Input"];

$textColor = $jsondata[$count + 2]["Input"];
$backgroundColor = $jsondata[$count + 3]["Input"];

$var = explode(",", $_GET['var']);

$arrFiles = scandir("image/");

foreach ($arrFiles as $af) {
    if (strpos($af, ".png")) {
        unlink("image/" . $af);
    }
}
if ($var[0] == 1) {

    $temp = $textColor;
    $textColor = $backgroundColor;
    $backgroundColor = $temp;
} else if ($var[1] != 0) {

    $font = $var[1];
    echo "<br> font - $font<br>";
} else if ($var[2] != 0) {

    $fontSize = $var[2];
    echo "<br> fontSize - $fontSize<br>";
}

echo "<br>$font $fontSize $textColor $backgroundColor $count";

$img->createImage($infoTextArray, $count, $fontSize, $font, $textColor, $backgroundColor);
$fileName = "prescription";
$img->saveAsPng($fileName);

echo "<br>$font $fontSize $textColor $backgroundColor $count";

$infoTextArray[$count]["Name"] = "font";
$infoTextArray[$count]["Input"] = $font;

$count++;

$infoTextArray[$count]["Name"] = "fontSize";
$infoTextArray[$count]["Input"] = $fontSize;

$count++;

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

header("location:index.php");
