<?php
require_once __DIR__ . '/common.php';
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
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <div class="container-fluid bg-light wrapper">

        <ul class="list-group w-m-5">
            <?php $result = $database->getData("SELECT * FROM contacts ORDER BY nome LIMIT 6"); ?>
            <?php while ($contact = $result->fetch()): ?>

            <li class="list-group-item d-flex justify-content-between pl-3 pr-3">
                <div class="col-11">
                    <div class="fw-bold">
                        <?= $contact["nome"] ?>
                        <?= $contact["cognome"] ?>
                        <i class="bi bi-three-dots"></i>
                    </div>
                    <i class="bi bi-telephone-fill"></i>
                    <?= $contact["numero"] ?> -
                    <i class="bi bi-envelope-fill"></i>
                    <?= $contact["email"] ?>
                </div>
                <div class="col">
                    <a href="./pages/formEditContact.php?id=<?= $contact['id'] ?>">
                        <span class="badge bg-primary rounded-pill m-1 d-block">
                            <i class="bi bi-pencil" style="color:white;"></i>
                        </span>
                    </a>
                    <a href="./pages/deleteContact.php?id=<?= $contact['id'] ?>">
                        <span class="badge bg-danger rounded-pill m-1 d-block">
                            <i class="bi bi-trash" style="color:white;"></i>
                        </span>
                    </a>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>

        <div class="row m-2">
            <div class="col d-flex justify-content-center">
                <a href="./pages/formAddContact.php">
                    <button class="btn btn-primary">
                        <i class="bi bi-person-fill-add" style="color:white;"></i> aggiungi contatto
                    </button>
                </a>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>