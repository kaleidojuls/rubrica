<?php

namespace User;

use User\QueriesWriter;
use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;

class Contact
{
    private DatabaseContract $database;

    public function __construct()
    {
        $this->database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);
    }

    public function getContactsInfo(): array
    {
        $result = $this->database->getData(
            "SELECT id, nome, cognome, email, numero, img_id 
            FROM contatti"
        );
        $contactsInfo = $result->fetchAll();

        return $contactsInfo;
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

    public function getFieldsInfo(string $tableName, array $tableFields, array $coditions = []): array|bool
    {
        $tableFieldsString = implode(", ", $tableFields);

        if (empty($coditions)) {
            $query = "SELECT $tableFieldsString FROM $tableName";
        } else {
            $coditionsString = implode(" AND ", $coditions);
            $query = "SELECT $tableFieldsString FROM $tableName WHERE $coditionsString";
        }

        $queryResult = $this->database->getData($query);
        $result = $queryResult->fetch();

        return $result;
    }

    public function addCompiledFields(array $compiledFields, array $uploadedFiles): void
    {
        $this->checkNumberAlreadyExists($compiledFields["numero"]);

        $query = QueriesWriter::getInsertQuery('contatti', $compiledFields);

        $imageQuery = array_key_exists("immagine_contatto", $uploadedFiles) ?
            QueriesWriter::getInsertQuery(
                "immagini_contatto", $uploadedFiles["immagine_contatto"]
            ) : "";

        if (empty($imageQuery)) {
            $this->database->DoWithTransaction([$query]);

        } else {
            $this->database->DoWithTransaction([$query, $imageQuery]);

            $this->addImgIdFK(
                $uploadedFiles["immagine_contatto"]["tmp_name"],
                $compiledFields["numero"]
            );
        }
    }

    public function editCompiledFields(array $compiledFields, array $uploadedFiles, int $contactId): void
    {
        $this->checkNumberAlreadyExists($compiledFields["numero"], $contactId);

        $query = QueriesWriter::getEditQuery("contatti", $compiledFields, $contactId);

        if (array_key_exists("immagine_contatto", $uploadedFiles)) {
            $imgId = $this->getFieldsInfo("contatti", ["img_id"], ["id = '$contactId'"]);

            $imageQuery = QueriesWriter::getEditQuery(
                "immagini_contatto",
                $uploadedFiles["immagine_contatto"],
                $imgId[0]
            );
        }

        if (!$imageQuery) {
            $this->database->DoWithTransaction([$query]);

        } else {
            $this->database->DoWithTransaction([$query, $imageQuery]);
        }
    }

    public function deleteFields(int $contactId)
    {
        $imgId = $this->getFieldsInfo("contatti", ["img_id"], ["id = '$contactId'"]);

        $this->database->setData("DELETE FROM contatti WHERE id = ?", [[$contactId]]);
        $this->database->setData("DELETE FROM immagini_contatto WHERE id = ?", [[$imgId[0]]]);
    }

    private function checkNumberAlreadyExists($compiledNumber, bool|int $contactId = false): void
    {
        $alreadyExists = $this->getFieldsInfo("contatti", ["id"], ["numero = '$compiledNumber'"]);

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

    private function addImgIdFK(string $imageTmpName, string $contactNumber): void
    {
        $imgId = $this->getFieldsInfo("immagini_contatto", ["id"], ["tmp_name = '$imageTmpName'"]);
        $contactId = $this->getFieldsInfo("contatti", ["id"], ["numero = '$contactNumber'"]);

        $addImageIdFK = QueriesWriter::getEditQuery('contatti', ['img_id' => $imgId[0]], $contactId[0]);
        $this->database->DoWithTransaction([$addImageIdFK]);
    }

}