<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '\common.php';

$database->setData("DELETE FROM contatti WHERE id = ?", [[$_GET["id"]]]);

header("Location: ../index.php");