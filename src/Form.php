<?php

namespace User\Form;

use Exception;
use User\Form\FormHelper;
use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;

class Form
{
    public function saveContactInfo(string $dbAction, int $contactId = null): void
    {
        $database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);

        $compiledInputs = $this->getCompiledInputs();
        $query = "";

        if ($dbAction == "ADD") {
            $query = $this->getInsertQuery($compiledInputs);

        } else if ($dbAction == "EDIT") {
            $query = $this->getEditQuery($compiledInputs, $contactId);
        }

        $database->setData($query, [array_values($compiledInputs)]);
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
        if ($inputName === "immagine_contatto") {
            return FormHelper::getEncodedImage($inputName);
        }

        return array_key_exists($inputName, $_POST) ? $_POST[$inputName] : null;
    }

    private function getInsertQuery(array $compiledInputs): string
    {
        $stringInputsNames = implode(", ", array_keys($compiledInputs));
        $valuesPlaceholder = "";

        for ($i = 0; $i < count($compiledInputs); $i++) {
            if ($i == count($compiledInputs) - 1) {
                $valuesPlaceholder .= " ?";
            } else {
                $valuesPlaceholder .= " ?,";
            }
        }

        $query = "INSERT INTO contacts ($stringInputsNames) VALUES ($valuesPlaceholder)";
        return $query;
    }

    private function getEditQuery(array $compiledInputs, int $contactId): string
    {
        $inputsNames = array_keys($compiledInputs);
        $attributesPlaceholder = "";

        for ($i = 0; $i < count($inputsNames); $i++) {
            if ($i == count($inputsNames) - 1) {
                $attributesPlaceholder .= $inputsNames[$i] . " = ?";
            } else {
                $attributesPlaceholder .= $inputsNames[$i] . " = ?,";
            }
        }

        $query = "UPDATE contacts SET $attributesPlaceholder 
            WHERE id = $contactId;";

        return $query;
    }
}