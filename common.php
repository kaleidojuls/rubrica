<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '\vendor\autoload.php';

use User\Form;
use User\Contact;

$contactAbstraction = new Contact();
$form = new Form($contactAbstraction);

function printContactFormLayout(): string
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

function insertProfileImage(string $imgUrl = "default", string $imgType = "")
{
    if ($imgUrl === "default") {
        return
            '<i class="bi bi-person-circle ps-3 pe-2" style="color: lightgrey; font-size: 4rem;"></i>';
    } else {
        return "<img src=\"data:$imgType;base64,$imgUrl\" alt=\"img\">";
    }
}