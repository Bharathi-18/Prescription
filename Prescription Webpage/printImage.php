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
            if (str_contains($af1, ".png")) {
                $filename = "image/" . $af1;
                $filename1 = "printerImage/" . $af1;
                $image = imagecreatefrompng($filename);
                $rotateIm = imagerotate($image, 90, 0);
                imagepng($rotateIm, $filename1);
            }
        }
    }

    function generateZPLCode()
    {

        $zplFiles = scandir("ZPLFiles/");

        foreach ($zplFiles as $zf) {
            if (str_contains($zf, ".zpl")) {
                unlink("ZPLFiles/" . $zf);
            }
        }

        $this->rotateImageToPrint();

        $imageFiles = scandir("printerImage/");
        $generatedImageArray = [];
        $index = 0;

        foreach ($imageFiles as $af) {
            if (str_contains($af, ".png")) {
                $generatedImageArray[$index++] = $af;
            }
        }

        foreach ($generatedImageArray as $gia) {
            $command = 'java -cp ImageToZPL.class ImageToZPL.java ' . $gia;
            $output = exec($command);
            $gia = str_replace(".png", "", $gia);
            $gia .= ".zpl";
            $this->writeInFile($gia, $output);
        }

        $files = scandir("ZPLFiles/");

        date_default_timezone_set("Asia/Calcutta");
        $d = date('d-m-Y h-i-s a');

        $zipname = "" . $d . ".zip";

        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);

        foreach ($files as $file) {
            if (str_contains($file, ".zpl")) {
                // echo $file . "<br>";
                $zip->addFile($file);
            }
        }
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }
}

$img = new phpTextToImage();

$count = 0;

$printerImageFiles = scandir("printerImage/");

foreach ($printerImageFiles as $pf) {
    if (str_contains($pf, ".png")) {
        unlink("printerImage/" . $pf);
    }
}

$img->generateZPLCode();

// header("location:index.php");
