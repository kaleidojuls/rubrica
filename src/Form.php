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

    public function saveCompiledInfo(string $action, int $id = null): void
    {
        $compiledInputs = $this->getCompiledInputs();

        if ($action == "ADD") {
            $this->tableAbstractionObj->addCompiledFields($compiledInputs);

        } else if ($action == "EDIT") {
            $this->tableAbstractionObj->editCompiledFields($compiledInputs, $id);
        }
    }

    private function getCompiledInputs(): array
    {
        $tableFields = $this->tableAbstractionObj->getTableFields();

        $fillableinputs = array_filter($_POST, fn($inputName) =>
            in_array($inputName, $tableFields), ARRAY_FILTER_USE_KEY);

        $fileInputs = array();
        foreach ($_FILES as $fileName => $fileInfo) {
            $fileInputs[$fileName] = $fileInfo["tmp_name"];
        }

        $compiledInputs = array_filter(array_merge($fillableinputs, $fileInputs));

        return $compiledInputs;
    }

}