<?php

namespace User\DatabaseAbstraction;

interface DatabaseContract
{
    const TYPE_PDO = "pdo";
    const TYPE_MySQLi = "mysqli";

    public function getData(string $query, array $params = []): DatabaseQueryResultContract;

    public function setData(string $command, array $items): void;

    public function DoWithTransaction(array $operations): void;

}