<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '\vendor\autoload.php';

use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;

$database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);