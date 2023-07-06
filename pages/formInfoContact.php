<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '\common.php';

use User\DatabaseAbstraction\Helper;

$id = $_GET['id'];
$selectedContact = $contactAbstraction->getFieldsInfo("contatti", ["*"], ["id = '$id'"]);

if (!$selectedContact) {
    die("Contatto non trovato");
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Contatto</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="form.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script type="module">
    import inputsConfig from "../src/inputsConfig.js";
    import CustomFormValidation from "../src/validation/CustomFormValidation.js"

    <?php $contactFields = $contactAbstraction->getTableFields(); ?>

    <?php foreach ($contactFields as $fieldName): ?>

    inputsConfig.<?= $fieldName ?>Config.value = "<?= Helper::AccessToValue($selectedContact, $fieldName) ?>";

    <?php endforeach ?>

    for (const input in inputsConfig) {
        if (input !== "configImmagineContatto") {
            inputsConfig[input].disabled = true;
        }
        inputsConfig[input].printInput();
    };
    </script>

</head>

<body>

    <div class="container-fluid bg-light wrapper">

        <div class="p-4 justify-content-center form-container">

            <form enctype="multipart/form-data" method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">

                <a href="../index.php">
                    <i class="back-icon bi bi-arrow-left ms-3" style="font-size: 2rem; color: lightgray;"></i>
                </a>

                <div class="row m-2">
                    <div class="col d-flex justify-content-center">
                        <div class="profile-pic"></div>
                    </div>
                </div>

                <?php echo printContactFormLayout(); ?>

                <div class="row m-3">
                    <div class="col d-flex justify-content-center">

                        <a href="./formEditContact.php?id=<?= $id ?>">
                            <button class="btn btn-primary mt-2 mx-2" type="button">
                                <i class="bi bi-person-lines-fill" style="color:white;"></i> Modifica
                            </button>
                        </a>
                        <a href="./deleteContact.php?id=<?= $id ?>">
                            <button class="btn btn-danger mt-2 mx-2" type="button">
                                <i class="bi bi-person-x-fill" style="color:white;"></i> Elimina
                            </button>
                        </a>

                    </div>
                </div>

            </form>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>