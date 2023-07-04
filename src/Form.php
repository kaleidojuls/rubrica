<?php

namespace User;

use User\DatabaseAbstraction\DatabaseContract;
use User\FormHelper;

class Form
{
    private DatabaseContract $database;

    function __construct(DatabaseContract $database)
    {
        $this->database = $database;
    }

    public function saveContactInfo(string $dbAction, int $contactId = null): void
    {
        $compiledInputs = $this->getCompiledInputs();
        $query = "";

        if ($dbAction == "ADD") {
            $numberExists = $this->checkNumberAlreadyExists($compiledInputs["numero"]);

            if ($numberExists) {
                echo "Il salvataggio non è andato a buon fine, 
                    esiste già un contatto con questo numero! 
                    <a href='../index.php'>Torna alla Rubrica</a>";
                die();
            } else {
                $query = $this->getInsertQuery($compiledInputs);
            }

        } else if ($dbAction == "EDIT") {
            $query = $this->getEditQuery($compiledInputs, $contactId);
        }

        $this->database->setData($query, [array_values($compiledInputs)]);
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

    private function checkNumberAlreadyExists($compiledNumber): bool|array
    {
        $result = $this->database->getData("SELECT numero FROM contatti WHERE EXISTS 
        (SELECT numero FROM contatti WHERE numero = ?)", [$compiledNumber]);
        $check = $result->fetch();

        return $check;
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

        $query = "INSERT INTO contatti ($stringInputsNames) VALUES ($valuesPlaceholder)";
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

        $query = "UPDATE contatti SET $attributesPlaceholder 
            WHERE id = $contactId;";

        return $query;
    }
}