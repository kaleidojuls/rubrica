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

function insertProfileImage(array $contact, Contact $contactAbstr, string $callPage = ""): void
{
    $contactImgId = $contact['img_id'];
    $root = $callPage === "index" ? "." : "../";

    $contactImg = $contactAbstr->getFieldsInfo(
        "immagini_contatto",
        ["content", "type"],
        ["id = '$contactImgId'"]
    );

    echo $contactImg ?
        "<img class=\"img-profile\" src=\"data:" . $contactImg['type'] . ";base64," . $contactImg['content'] . "\" alt=\"img\">" :
        "<img class=\"img-profile\" src=\"$root/src/assets/default-profile-img.png\" alt=\"Icon by alfanz\"
        title=\"Icon by alfanz\">";
}