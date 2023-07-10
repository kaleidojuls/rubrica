<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '\common.php';

$id = $_GET['id'];
$selectedContact = $contactAbstraction->getFieldsInfo("contatti", ["id"], ["id = '$id'"]);

if (!$selectedContact) {
    die("Contatto non trovato");
}

$form->manageInfo("CANCEL", $id);

header("Location: ../index.php");