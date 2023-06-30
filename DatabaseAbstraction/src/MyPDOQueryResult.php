<?php

namespace User\DatabaseAbstraction;

use PDOStatement;
use User\DatabaseAbstraction\DatabaseQueryResultContract;

class MySQULiQueryResult implements DatabaseQueryResultContract
{
    private \mysqli_result $result;

    public function __construct(\mysqli_result $result)
    {

        $this->result = $result;

    }
    public function fetch(): bool|array|null
    {
        return $this->result->fetch_assoc();
    }

    public function fetchAll(): array
    {
        return $this->result->fetch_all();
    }
}

class MyPDOQueryResult implements DatabaseQueryResultContract
{

    private PDOStatement $statement;

    public function __construct(PDOStatement $statement)
    {

        $this->statement = $statement;

    }

    public function fetch(): mixed
    {
        return $this->statement->fetch();
    }

    public function fetchAll(): array
    {
        return $this->statement->fetchAll();
    }

}