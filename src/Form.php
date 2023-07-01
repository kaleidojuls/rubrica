<?php

namespace User\Form;

class Form
{
    private string $formMethod;

    function __construct(string $formMethod)
    {
        $this->formMethod = $formMethod;
    }

    public function get_input_value(string $inputName): string|null
    {
        $dataArray = $this->formMethod === "POST" ? $_POST : $_GET;

        if ($inputName === "immagine_contatto")
            return $this->get_profile_image_usable($inputName);

        return array_key_exists($inputName, $dataArray) ? $dataArray[$inputName] : null;
    }

    public function save_datas(): void
    {

        $inputFieldsNames = array_diff_key(array_keys($_POST, !""), ["MAX_FILE_SIZE"]);
        $inputFieldsValues = array_diff(array_values($_POST), [$_POST["MAX_FILE_SIZE"], ""]);
        $column_names = implode(", ", $inputFieldsNames);
        $values = implode(", ", $inputFieldsValues);

        $query = "INSERT INTO contacts ($column_names) VALUES ($values)";

        echo $query;


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