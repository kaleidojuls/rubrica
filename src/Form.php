<?php

namespace User;

use User\Contact;

class Form
{
    private Contact $tableAbstractionObj;

    function __construct(Contact $tableAbstractionObj)
    {
        $this->tableAbstractionObj = $tableAbstractionObj;
    }

    public function manageInfo(string $action, int $id = null): void
    {
        $compiledInputs = $this->getCompiledInputs();

        //ottiene un array come quello di $FILES ma ogni file 
        //ha solo le proprietà tmp_name e type
        $uploadedFiles = $this->getUploadedFiles();

        if ($action == "ADD") {
            $this->tableAbstractionObj->addCompiledFields($compiledInputs, $uploadedFiles);

        } else if ($action == "EDIT") {
            $this->tableAbstractionObj->editCompiledFields($compiledInputs, $uploadedFiles, $id);

        } else if ($action == "CANCEL") {
            $this->tableAbstractionObj->deleteFields($id);
        }
    }

    private function getCompiledInputs(): array
    {
        $tableFields = $this->tableAbstractionObj->getTableFields();

        //filtra post controllando se il nome dell'input è parte dei campi della tabella
        //e che non sia un campo vuoto. 
        //Ottiene un array come $_POST ma con solo i campi compilati
        $compiledInputs = array_filter(
            $_POST,
            fn($inputName) => in_array($inputName, $tableFields) && !empty($_POST[$inputName]),
            ARRAY_FILTER_USE_KEY
        );

        return $compiledInputs;
    }

    private function getUploadedFiles(): array
    {
        foreach ($_FILES as $file) {
            if ($file["error"] === 1 || $file["error"] === 2) {
                die("Il file caricato è troppo grande! <a href='../index.php'>Torna alla Rubrica</a>");
            }
        }

        $uploadedFiles = array_filter($_FILES, fn($fileInfo) =>
            !empty($fileInfo["tmp_name"]));

        $simplifiedFiles = array_map(function ($fileInfo) {
            $fileBinary = fread(fopen($fileInfo["tmp_name"], "r"), filesize($fileInfo["tmp_name"]));

            return $fileInfo = array(
                "tmp_name" => $fileInfo["tmp_name"],
                "type" => $fileInfo["type"],
                "content" => base64_encode($fileBinary)
            );
        }, $uploadedFiles);

        return $simplifiedFiles;
    }

}