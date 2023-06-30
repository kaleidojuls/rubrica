<?php

namespace User\DatabaseAbstraction;

use User\DatabaseAbstraction\DatabaseContract;
use Exception;
use PDO;
use PDOException;
use Dotenv\Dotenv;

class DatabaseFactory
{
    public static function Create(string $type = DatabaseContract::TYPE_PDO): DatabaseContract|null
    {
        $dbConfig = self::GetDBConfig();


        if ($type == DatabaseContract::TYPE_PDO) {

            return self::createWithPDO($dbConfig);

        } else if ($type == DatabaseContract::TYPE_MySQLi) {

            return self::CreateWithMySQLi($dbConfig);

        } else {

            return null;

        }
    }

    private static function createWithPDO(DBConfig $dbConfig): MyPDO
    {
        try {

            $pdo = new MyPDO($dbConfig);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {

            throw new Exception("Database connection failed with error: {$e->getMessage()}");

        }
    }

    private static function CreateWithMySQLi(DBConfig $dbConfig): MySQLi
    {
        try {

            $mysqli = new MySQLi($dbConfig);

            return $mysqli;

        } catch (Exception $e) {

            throw new Exception("Database connection failed with error: {$e->getMessage()}");

        }
    }

    private static function GetDBConfig(): DBConfig
    {
        $path = $_SERVER["DOCUMENT_ROOT"];
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();
        $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_PORT', 'DB_USER', 'DB_PASS']);

        $host = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $port = $_ENV['DB_PORT'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];

        return new DBConfig(
            $host,
            $dbName,
            $port,
            $user,
            $password
        );
    }
}