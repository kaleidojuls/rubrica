<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '\vendor\autoload.php';

use User\DatabaseAbstraction\DatabaseFactory;
use User\DatabaseAbstraction\DatabaseContract;

$database = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container justify-content-center">
        <ul class="list-group">
            <?php $result = $database->getData("SELECT * FROM contacts"); ?>
            <?php while ($contact = $result->fetch()): ?>
            <li class="list-group-item">
                <?= $contact["nome"] ?>
                <?= $contact["cognome"] ?> -
                <?= $contact["numero"] ?> -
                <?= $contact["email"] ?>
            </li>
            <?php endwhile; ?>
        </ul>
        <a href="./pages/formAggiungiContatto.php">
            <button class="btn btn-primary">
                aggiungi contatto
            </button>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>