<?php

namespace User\DatabaseAbstraction;

class MySQLi extends \mysqli implements DatabaseContract
{
    public function __construct(DBConfig $DBConfig)
    {
        parent::__construct(
            $DBConfig->host,
            $DBConfig->user,
            $DBConfig->password,
            $DBConfig->dbName,
            $DBConfig->port
        );
    }

    public function getData(string $query, array $params = []): DatabaseQueryResultContract
    {

        $statement = $this->prepare($query);

        $statement->execute($params);

        $result = $statement->get_result();

        return new MySQLiQueryResult($result);

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

            $this->begin_transaction();

            foreach ($operations as $operation) {

                $this->query($operation);

            }

            $this->commit();

        } catch (\Exception $e) {

            $this->rollBack();

            throw new \Exception("Transaction aborted: " . $e->getMessage());

        }

    }

    public function __destruct()
    {
        $this->close();
    }

}