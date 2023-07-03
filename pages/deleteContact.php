<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '\common.php';

$database->setData("DELETE FROM contacts WHERE id = ?", [[$_GET["id"]]]);

header("Location: ../index.php");