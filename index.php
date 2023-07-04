<?php
require_once __DIR__ . '/common.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrica Contatti</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <div class="container-fluid bg-light wrapper">

        <ul class="list-group contact-list-group">
            <?php $result = $database->getData("SELECT * FROM contatti ORDER BY nome"); ?>
            <?php while ($contact = $result->fetch()): ?>

            <li class="list-group-item d-flex row contact-list-item">

                <div class="col-2 d-flex align-items-center justify-content-center ps-4">
                    <i class="bi bi-person-circle ps-3 pe-2" style="color: lightgrey; font-size: 4rem;"></i>
                </div>

                <div class="col-8 d-flex flex-column justify-content-center ps-4">
                    <div class="fw-bold">
                        <?= $contact["nome"] ?>
                        <?= $contact["cognome"] ?>
                        <a href="./pages/formInfoContact.php?id=<?= $contact['id'] ?>">
                            <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </div>
                    <div>
                        <div class="d-inline-block me-3">
                            <i class="bi bi-telephone-fill"></i>
                            <?= $contact["numero"] ?>
                        </div>
                        <div class="d-inline-block">
                            <i class="bi bi-envelope-fill"></i>
                            <?= $contact["email"] ?>
                        </div>
                    </div>
                </div>

                <div class="col-2 d-flex flex-column justify-content-center align-items-end">
                    <a href="./pages/formEditContact.php?id=<?= $contact['id'] ?>">
                        <button class="action-icon btn btn-primary m-1">
                            <i class="bi bi-pencil" style="color:white;"></i>
                        </button>
                    </a>
                    <a href="./pages/deleteContact.php?id=<?= $contact['id'] ?>">
                        <button class="action-icon btn btn-danger m-1">
                            <i class="bi bi-trash" style="color:white;"></i>
                        </button>
                    </a>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>

        <div class="row m-2">
            <div class="col d-flex justify-content-center">
                <a href="./pages/formAddContact.php">
                    <button class="btn btn-success">
                        <i class="bi bi-person-fill-add" style="color:white;"></i> Aggiungi Nuovo Contatto
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