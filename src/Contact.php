<?php

namespace User;

use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;

class Contact
{
    private DatabaseContract $database;

    public function __construct()
    {
        $this->database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);
    }

    public function getTableFields(string $tableName = "contatti"): array
    {
        $result = $this->database->getData(
            "SELECT group_concat(COLUMN_NAME)
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = '$tableName';"
        );
        $stringTableFields = $result->fetch();

        return array_diff(
            explode(",", $stringTableFields[0]),
            ["id", "active", "created_at", "img_id"]
        );
    }

    public function addCompiledFields(array $compiledFields, array $uploadedFiles): void
    {
        $this->checkNumberAlreadyExists($compiledFields["numero"]);

        $query = $this->getInsertQuery('contatti', $compiledFields);

        $imageQuery = array_key_exists("immagine_contatto", $uploadedFiles) ?
            $this->getInsertQuery(
                "immagini_contatto", $uploadedFiles["immagine_contatto"]
            ) : "";

        if (empty($imageQuery)) {
            $this->database->DoWithTransaction([$query]);

        } else {
            $this->database->DoWithTransaction([$query, $imageQuery]);

            $imageTmpName = $uploadedFiles["immagine_contatto"]["tmp_name"];
            $resultImgId = $this->database->getData(
                "SELECT id FROM immagini_contatto WHERE tmp_name = '$imageTmpName'"
            );

            $contactNumber = $compiledFields["numero"];
            $resultContactId = $this->database->getData(
                "SELECT id FROM contatti WHERE numero = '$contactNumber'"
            );

            $ImageId = $resultImgId->fetch();
            $contactId = $resultContactId->fetch();

            $addImageIdFK = $this->getEditQuery('contatti', ['img_id' => $ImageId[0]], $contactId[0]);
            $this->database->DoWithTransaction([$addImageIdFK]);
        }
    }

    public function editCompiledFields(array $compiledFields, array $uploadedFiles, int $contactId): void
    {
        $this->checkNumberAlreadyExists($compiledFields["numero"], $contactId);

        $query = $this->getEditQuery("contatti", $compiledFields, $contactId);

        $imageQuery = array_key_exists("immagine_contatto", $uploadedFiles) ?
            $this->getEditQuery(
                "immagini_contatto",
                $uploadedFiles["immagine_contatto"],
                $contactId
            ) : "";

        if (empty($imageQuery)) {
            $this->database->DoWithTransaction([$query]);
        } else {
            $this->database->DoWithTransaction([$query, $imageQuery]);
        }
    }

    private function checkNumberAlreadyExists($compiledNumber, bool|int $contactId = false): void
    {
        $result = $this->database->getData(
            "SELECT id FROM contatti WHERE numero = ?",
            [$compiledNumber]
        );

        $alreadyExists = $result->fetch();

        if (
            $contactId && $alreadyExists && $alreadyExists["id"] !== $contactId ||
            !$contactId && $alreadyExists
        ) {
            echo "Il salvataggio non è andato a buon fine, 
                esiste già un contatto con questo numero! 
                <a href='../index.php'>Torna alla Rubrica</a>";
            die();
        }
    }

    private function getInsertQuery(string $tableName, array $compiledFields): string
    {
        $stringFieldNames = implode(", ", array_keys($compiledFields));
        $stringValues = implode("', '", array_values($compiledFields));

        $query = "INSERT INTO $tableName ($stringFieldNames) VALUES ('$stringValues')";

        return $query;
    }

    private function getEditQuery(string $tableName, array $compiledFields, int $contactId): string
    {
        foreach ($compiledFields as $fieldName => $fieldValue) {
            $keyValueAssociations[] = "$fieldName = '$fieldValue'";
        }

        $fieldsPlaceholder = implode(", ", $keyValueAssociations);

        $query = "UPDATE $tableName SET $fieldsPlaceholder 
            WHERE id = $contactId;";

        return $query;
    }
}