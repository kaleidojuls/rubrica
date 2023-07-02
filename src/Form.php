<?php

namespace User\Form;

use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;


class Form
{
    private string $formMethod;

    function __construct(string $formMethod)
    {
        $this->formMethod = $formMethod;
    }

    private function get_input_value(string $inputName): string|null
    {
        $dataArray = $this->formMethod === "POST" ? $_POST : $_GET;

        if ($inputName === "immagine_contatto")
            return $this->get_profile_image_usable($inputName);

        return array_key_exists($inputName, $dataArray) ? $dataArray[$inputName] : null;
    }

    public function save_datas_on_post(): void
    {
        $database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $compiledInputs = $this->get_compiled_inputs();

            $fields_names = implode(", ", array_keys($compiledInputs));
            $fields_values = array_values($compiledInputs);
            $values_placeholder = "";

            for ($i = 0; $i < count($compiledInputs); $i++) {
                if ($i == count($compiledInputs) - 1) {
                    $values_placeholder .= " ?";
                } else {
                    $values_placeholder .= " ?,";
                }
            }

            $query = "INSERT INTO contacts ($fields_names) VALUES ($values_placeholder)";

            $database->setData($query, [$fields_values]);
        }
    }

    private function get_compiled_inputs(): array
    {

        $allInputs = array_merge(
            array_diff($_POST, ["MAX_FILE_SIZE" => $_POST["MAX_FILE_SIZE"]]),
            ["immagine_contatto" => $this->get_input_value("immagine_contatto")]
        );

        return array_filter($allInputs);
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