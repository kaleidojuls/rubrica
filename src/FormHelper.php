<?php

namespace User\Form;

class FormHelper
{
    public static function getEncodedImage(string $fileInputName): string|null
    {
        if (array_key_exists($fileInputName, $_FILES)) {
            $fileName = $_FILES[$fileInputName]["tmp_name"];
            $fileType = $_FILES[$fileInputName]["type"];
            $fileIsImage = str_contains($fileType, "image");

            return $fileIsImage ? self::base64EncodeImage($fileName, $fileType) : null;
        }

        return null;
    }

    public static function base64EncodeImage(string $fileName, string $fileType): string
    {
        $imgBinary = fread(fopen($fileName, "r"), filesize($fileName));

        return 'data:image/' . $fileType . ';base64,' . base64_encode($imgBinary);
    }
}