<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '\vendor\autoload.php';

use User\Form\Form;

$form = new Form($_SERVER["REQUEST_METHOD"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form->save_datas_on_post();
    header("Location: ../index.php");
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
    import Input from "../src/Input.js";
    import CustomValidation from "../src/validation/CustomFormValidation.js";

    for (const config in inputsConfig) {
        const inputObject = new Input(inputsConfig[config]);
        inputObject.printInput();
    };

    const formValidation = new CustomValidation();
    formValidation.validationOnChange();
    </script>

</head>

<body>
    <div class="container-fluid">
        <div class="row p-4 justify-content-center">

            <div class="col col-lg-7 form-container">
                <form enctype="multipart/form-data" method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">

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
                            <button class="btn btn-primary mt-2" type="submit">Salva Nuovo Contatto</button>
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