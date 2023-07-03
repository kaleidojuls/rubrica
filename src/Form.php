<?php

namespace User\Form;

use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;
use User\Form\FormHelper;

class Form
{
    private string $formMethod;

    function __construct(string $formMethod = "POST")
    {
        $this->formMethod = $formMethod;
    }

    public function saveContactInfo(): void
    {
        $database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);

        if ($_SERVER["REQUEST_METHOD"] == $this->formMethod) {

            $compiledInputs = $this->getCompiledInputs();

            $fields_names = implode(", ", array_keys($compiledInputs));
            $values_placeholder = "";

            for ($i = 0; $i < count($compiledInputs); $i++) {
                if ($i == count($compiledInputs) - 1) {
                    $values_placeholder .= " ?";
                } else {
                    $values_placeholder .= " ?,";
                }
            }

            $query = "INSERT INTO contacts ($fields_names) VALUES ($values_placeholder)";

            $database->setData($query, [array_values($compiledInputs)]);
        }
    }

    private function getCompiledInputs(): array
    {
        $allInputs = array_merge(
            array_diff($_POST, ["MAX_FILE_SIZE" => $_POST["MAX_FILE_SIZE"]]),
            ["immagine_contatto" => $this->getInputValue("immagine_contatto")]
        );

        return array_filter($allInputs);
    }

    private function getInputValue(string $inputName): string|null
    {
        $dataArray = $this->formMethod == "POST" ? $_POST : $_GET;

        if ($inputName === "immagine_contatto") {
            return FormHelper::getEncodedImage($inputName);
        }

        return array_key_exists($inputName, $dataArray) ? $dataArray[$inputName] : null;
    }
}