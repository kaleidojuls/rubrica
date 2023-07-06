<?php

namespace User;

class QueriesWriter
{
    public static function getInsertQuery(string $tableName, array $compiledFields): string
    {
        $stringFieldNames = implode(", ", array_keys($compiledFields));
        $stringValues = implode("', '", array_values($compiledFields));

        $query = "INSERT INTO $tableName ($stringFieldNames) VALUES ('$stringValues')";

        return $query;
    }

    public static function getEditQuery(string $tableName, array $compiledFields, int $id): string
    {
        foreach ($compiledFields as $fieldName => $fieldValue) {
            $keyValueAssociations[] = "$fieldName = '$fieldValue'";
        }

        $fieldsPlaceholder = implode(", ", $keyValueAssociations);

        $query = "UPDATE $tableName SET $fieldsPlaceholder 
            WHERE id = $id;";

        return $query;
    }

}