<?php

session_start();

class phpTextToImage
{

    function writeInFile($fileName, $value)
    {
        $fileName = "ZPLFiles/" . $fileName;
        $file = fopen($fileName, 'w');
        fwrite($file, $value);
        fclose($file);
    }

    function rotateImageToPrint()
    {

        $arrFiles1 = scandir("image/");
        foreach ($arrFiles1 as $af1) {
            if (strpos($af1, ".png") !== false) {
                $filename = "image/" . $af1;
                $filename1 = "printerImage/" . $af1;
                $image = imagecreatefrompng($filename);
                $rotateIm = imagerotate($image, 90, 0);
                imagepng($rotateIm, $filename1);
            }
        }
    }

    function downloadZplCode()
    {
        $files = scandir("ZPLFiles/");

        date_default_timezone_set("Asia/Calcutta");
        $d = date('d-m-Y h-i-s a');

        $fileName = "prescription " . $d . ".zpl";

        $flag = 0;

        foreach ($files as $file) {
            if (strpos($file, ".zpl") !== false) {
                $flag = 1;
            }
        }

        if ($flag == 1) {

            header("Cache-Control: public");
            header("Content-Description: FIle Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Emcoding: binary");

            readfile("ZPLFiles/prescription.zpl");
        }
    }

    function generateZPLCode()
    {

        $zplFiles = scandir("ZPLFiles/");
        foreach ($zplFiles as $zf) {
            if (strpos($zf, ".zpl") !== false) {
                unlink("ZPLFiles/" . $zf);
            }
        }

        $this->rotateImageToPrint();

        $imageFiles = scandir("printerImage/");
        $generatedImageArray = [];
        $index = 0;

        foreach ($imageFiles as $af) {
            if (strpos($af, ".png") !== false) {
                $generatedImageArray[$index++] = $af;
            }
        }
        $output = "";
        foreach ($generatedImageArray as $gia) {
            $command = 'java -cp ImageToZPL.class ImageToZPL.java ' . $gia;
            $output = $output . "\n" . exec($command);
        }
        $gia = "prescription.zpl";
        $this->writeInFile($gia, $output);
        $this->downloadZplCode();
    }
}

$img = new phpTextToImage();

$count = 0;

$printerImageFiles = scandir("printerImage/");

foreach ($printerImageFiles as $pf) {
    if (strpos($pf, ".png") !== false) {
        unlink("printerImage/" . $pf);
    }
}

$img->generateZPLCode();

// header("location:index.php");
