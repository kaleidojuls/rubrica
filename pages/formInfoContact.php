<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '\common.php';

use User\DatabaseAbstraction\Helper;

$id = $_GET['id'];
$result = $database->getData("SELECT * FROM contacts where id = ?", [$id]);
$selectedContact = $result->fetch();

if (!$selectedContact) {
    die("Contact not found");
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Aggiungi Contatto a Rubrica</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="form.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script type="module">
    import inputsConfig from "../src/inputsConfig.js";
    import CustomFormValidation from "../src/validation/CustomFormValidation.js"

    inputsConfig.configImmagineContatto.value = "<?= Helper::AccessToValue($selectedContact, "immagine_contatto") ?>";
    inputsConfig.configNome.value = "<?= Helper::AccessToValue($selectedContact, "nome") ?>";
    inputsConfig.configCognome.value = "<?= Helper::AccessToValue($selectedContact, "cognome") ?>";
    inputsConfig.configSocieta.value = "<?= Helper::AccessToValue($selectedContact, "societa") ?>";
    inputsConfig.configQualifica.value = "<?= Helper::AccessToValue($selectedContact, "qualifica") ?>";
    inputsConfig.configEmail.value = "<?= Helper::AccessToValue($selectedContact, "email") ?>";
    inputsConfig.configNumero.value = "<?= Helper::AccessToValue($selectedContact, "numero") ?>";
    inputsConfig.configCompleanno.value = "<?= Helper::AccessToValue($selectedContact, "compleanno") ?>";

    for (const input in inputsConfig) {
        if (input !== "configImmagineContatto") {
            inputsConfig[input].disabled = true;
        }
        inputsConfig[input].printInput();
    };
    </script>

</head>

<body>

    <div class="container-fluid bg-light">
        <div class="row p-4 justify-content-center">

            <div class="col col-lg-7 form-container bg-white">
                <form enctype="multipart/form-data" method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">

                    <div class="row m-2">
                        <div class="col d-flex justify-content-center">
                            <div class="profile-pic">
                                <div id="col-immagine_contatto"></div>
                            </div>
                        </div>
                        <div id="immagine_contatto-invalid-feedback"></div>
                    </div>

                    <div class="row m-3">
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
                    </div>

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>