<?php

namespace User;

use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;

// use User\ImageHelper;

class Contact
{
    private DatabaseContract $database;

    public function __construct()
    {
        $this->database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);
    }

    public function getTableFields(): array
    {
        $result = $this->database->getData(
            "SELECT group_concat(COLUMN_NAME)
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = 'contatti';"
        );
        $stringTableFields = $result->fetch();

        return array_diff(
            explode(",", $stringTableFields["group_concat(COLUMN_NAME)"]),
            ["id", "active", "created_at"]
        );
    }

    public function addCompiledFields(array $compiledFields): void
    {
        $query = "";

        $numberExists = $this->checkNumberAlreadyExists($compiledFields["numero"]);

        if ($numberExists) {
            echo "Il salvataggio non è andato a buon fine, 
                    esiste già un contatto con questo numero! 
                    <a href='../index.php'>Torna alla Rubrica</a>";
            die();
        } else {
            $query = $this->getInsertQuery($compiledFields);
        }

        $this->database->setData($query, [array_values($compiledFields)]);
    }

    public function editCompiledFields(array $compiledFields, int $contactId): void
    {
        $query = "";

        $query = $this->getEditQuery($compiledFields, $contactId);

        $this->database->setData($query, [array_values($compiledFields)]);
    }

    private function checkNumberAlreadyExists($compiledNumber): bool|array
    {
        $result = $this->database->getData(
            "SELECT numero FROM contatti WHERE EXISTS 
            (SELECT numero FROM contatti WHERE numero = ?)",
            [$compiledNumber]
        );

        $check = $result->fetch();

        return $check;
    }

    private function getInsertQuery(array $compiledFields): string
    {
        $stringFieldNames = implode(", ", array_keys($compiledFields));
        $valuesPlaceholder = "";

        for ($i = 0; $i < count($compiledFields); $i++) {
            if ($i == count($compiledFields) - 1) {
                $valuesPlaceholder .= " ?";
            } else {
                $valuesPlaceholder .= " ?,";
            }
        }

        $query = "INSERT INTO contatti ($stringFieldNames) VALUES ($valuesPlaceholder)";

        return $query;
    }

    private function getEditQuery(array $compiledFields, int $contactId): string
    {
        $fieldNames = array_keys($compiledFields);
        $fieldsPlaceholder = "";

        for ($i = 0; $i < count($fieldNames); $i++) {
            if ($i == count($fieldNames) - 1) {
                $fieldsPlaceholder .= $fieldNames[$i] . " = ?";
            } else {
                $fieldsPlaceholder .= $fieldNames[$i] . " = ?,";
            }
        }

        $query = "UPDATE contatti SET $fieldsPlaceholder 
            WHERE id = $contactId;";

        return $query;
    }
}