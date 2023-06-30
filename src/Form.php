<?php

namespace User\Form;

class Form
{
    private string $formMethod;

    function __construct($formMethod)
    {
        $this->formMethod = $formMethod;

    }

    // public static function Create_input(InputObject $input) {

    // }

    public function get_input_value(string $inputName): mixed
    {
        $dataArray = $this->formMethod === "POST" ? $_POST : $_GET;

        if ($inputName === "immagineContatto")
            return $this->get_profile_image_usable($inputName);

        return array_key_exists($inputName, $dataArray) ? $dataArray[$inputName] : null;
    }

    private function get_profile_image_usable(string $fileInputName): string|null
    {
        if (array_key_exists($fileInputName, $_FILES)) {
            $fileName = $_FILES[$fileInputName]["tmp_name"];
            $fileType = $_FILES[$fileInputName]["type"];
            $fileIsImage = str_contains($fileType, "image");

            return $fileIsImage ? $this->base64_encode_image($fileName, $fileType) : null;
        }

        return null;
    }

    private function base64_encode_image(string $fileName, string $fileType): string
    {
        $imgBinary = fread(fopen($fileName, "r"), filesize($fileName));
        return 'data:image/' . $fileType . ';base64,' . base64_encode($imgBinary);
    }
}
;