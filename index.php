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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>

    <div class="container-fluid bg-light wrapper">

        <ul class="list-group contact-list-group">

            <?php $contacts = $contactAbstraction->getContactsInfo(); ?>

            <?php foreach ($contacts as $contact): ?>

            <li class="list-group-item contact-list-item justify-content-center">
                <div class="row">

                    <div class="col-3 d-flex align-items-center justify-content-center p-0">

                        <div class="profile-img-container">
                            <?php insertProfileImage($contact, $contactAbstraction, 'index') ?>
                        </div>

                    </div>

                    <div class="col-7 w-70 d-flex flex-column justify-content-center">
                        <div class="fw-bold">
                            <?= $contact["nome"] ?>
                            <?= $contact["cognome"] ?>
                            <a href="./pages/formInfoContact.php?id=<?= $contact['id'] ?>">
                                <i class="bi bi-info-circle-fill"></i>
                            </a>
                        </div>
                        <div>
                            <div class="d-inline-block">
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

                </div>
            </li>

            <?php endforeach //endwhile; ?>

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