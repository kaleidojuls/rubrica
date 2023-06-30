<?php

namespace User\DatabaseAbstraction;

use Exception;
use User\DatabaseAbstraction\DatabaseContract;

class MyPDO extends \PDO implements DatabaseContract
{
    public function __construct(DBConfig $DBConfig)
    {
        $dsn = $this->getDsn($DBConfig->host, $DBConfig->port, $DBConfig->dbName);
        $username = $DBConfig->user;
        $password = $DBConfig->password;
        $options = [];

        parent::__construct($dsn, $username, $password, $options);
    }

    public function getData(string $query, array $params = []): DatabaseQueryResultContract
    {

        $statement = $this->prepare($query);
        $statement->execute($params);

        return new MyPDOQueryResult($statement);
    }

    public function setData(string $command, array $items): void
    {

        $statement = $this->prepare($command);

        foreach ($items as $item) {
            $statement->execute($item);
        }

    }

    public function DoWithTransaction(array $operations): void
    {
        try {

            $this->beginTransaction();

            foreach ($operations as $operation) {
                $this->exec($operation);
            }

            $this->commit();

        } catch (Exception $e) {

            $this->rollBack();

            throw new Exception("Transaction aborted: " . $e->getMessage());

        }
    }

    private function getDsn(string $host, string $port, string $dbName)
    {
        return "mysql:" .
            "host=$host;" .
            "port=$port;" .
            "dbname=$dbName";
    }

}