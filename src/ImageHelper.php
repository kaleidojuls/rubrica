<?php

namespace User;

class FileHelper
{
    public static function getEncodedImage(array $imageFile): string|null
    {
        $fileName = $imageFile["tmp_name"];
        $fileType = $imageFile["type"];
        $fileIsImage = str_contains($fileType, "image");

        return $fileIsImage ? self::base64EncodeImage($fileName, $fileType) : null;
    }

    public static function base64EncodeImage(string $fileName, string $fileType): string
    {
        $imgBinary = fread(fopen($fileName, "r"), filesize($fileName));

        return 'data:image/' . $fileType . ';base64,' . base64_encode($imgBinary);
    }
}