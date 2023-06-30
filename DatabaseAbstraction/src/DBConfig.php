<?php

namespace User\DatabaseAbstraction;

class DBConfig
{

    public string $host;

    public string $dbName;

    public string $port;

    public string $user;

    public string $password;

    public function __construct($host, $dbName, $port, $user, $password)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }

}