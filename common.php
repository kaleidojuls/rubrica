<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '\vendor\autoload.php';

use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;

$database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);

function printCommonFormLayout(): string
{
    return ('<div class="row m-3">
        <div class="col" id="col-nome"></div>
        <div class="col-12 col-md" id="col-cognome"></div>
        </div>

        <div class="row m-3">
        <div class="col" id="col-societa"></div>
        <div class="col-12 col-md" id="col-qualifica"></div>
        </div>

        <div class="row m-3">
        <div class="col" id="col-email"></div>
        <div class="col-12 col-md" id="col-numero"></div>
        </div>

        <div class="row m-3">
        <label for="compleanno">Data di Nascita:</label>
        <div class="col" id="col-compleanno"></div>
        </div>');
}