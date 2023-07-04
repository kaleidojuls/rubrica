<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '\common.php';

use User\Form\Form;

$form = new Form($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form->saveContactInfo("ADD");
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Nuovo Contatto</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="form.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script type="module">
    import inputsConfig from "../src/inputsConfig.js";
    import CustomFormValidation from "../src/validation/CustomFormValidation.js"

    for (const input in inputsConfig) {
        inputsConfig[input].printInput();
    };

    const customValidation = new CustomFormValidation(inputsConfig);
    customValidation.activateCustom();
    </script>

</head>

<body>

    <div class="container-fluid bg-light wrapper">

        <div class="row p-4 justify-content-center form-container bg-white">
            <div class="col">
                <form enctype="multipart/form-data" method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">

                    <a href="../index.php">
                        <i class="back-icon bi bi-arrow-left ms-3" style="font-size: 2rem; color: lightgray;"></i>
                    </a>

                    <div class="row m-2">
                        <div class="col d-flex justify-content-center">
                            <div class="profile-pic">
                                <label for="immagine_contatto" class="custom-input-button">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                                    <div id="col-immagine_contatto"></div>
                                </label>
                            </div>
                        </div>
                        <div id="immagine_contatto-invalid-feedback"></div>
                    </div>

                    <?php echo printContactFormLayout(); ?>

                    <div class="row m-3">
                        <div class="col d-flex justify-content-center">
                            <button class="btn btn-success mt-2" type="submit">
                                <i class="bi bi-person-check-fill" style="color:white;"></i> Salva Nuovo Contatto
                            </button>
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