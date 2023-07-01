<?php
require_once __DIR__ . '\vendor\autoload.php';

use User\Form\Form;

$form = new Form($_SERVER["REQUEST_METHOD"]);

$form->save_datas_on_post();

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
    import CustomValidation from "./src/validation/CustomFormValidation.js";
    const formValidation = new CustomValidation();
    formValidation.validationOnChange();
    </script>

</head>

<body>
    <div class="container-fluid">
        <div class="row p-4 justify-content-center">

            <div class="col col-lg-7 form-container">
                <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">

                    <div class="row m-2">
                        <div class="col d-flex justify-content-center">
                            <div class="profile-pic">
                                <label for="immagine_contatto" class="custom-input-button">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                                    <input type="file" class="form-control" id="immagine_contatto"
                                        name="immagine_contatto">
                                </label>
                            </div>
                        </div>
                        <div id="immagine_contatto-invalid-feedback"></div>
                    </div>

                    <div class="row m-3">
                        <div class="col">
                            <div class="input-group has-validation">
                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="*Nome"
                                    value="<?php echo $form->get_input_value('nome') ?>" required>
                                <div class="invalid-feedback" id="nome-invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md">
                            <input type="text" class="form-control" name="cognome" id="cognome"
                                value="<?php echo $form->get_input_value('cognome') ?>" placeholder="Cognome">
                            <div class="invalid-feedback" id="cognome-invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col">
                            <div class="input-group has-validation">
                                <span class="input-group-text">
                                    <i class="bi bi-briefcase-fill"></i>
                                </span>
                                <input type="text" class="form-control" name="societa" id="societa" maxlength="20"
                                    value="<?php echo $form->get_input_value('societa') ?>" placeholder="Società">
                                <div class="invalid-feedback" id="societa-invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md">
                            <input type="text" class="form-control" name="qualifica" id="qualifica" maxlength="20"
                                value="<?php echo $form->get_input_value('qualifica') ?>" placeholder="Qualifica">
                            <div class="invalid-feedback" id="qualifica-invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col">
                            <div class="input-group has-validation">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope-at-fill"></i>
                                </span>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="<?php echo $form->get_input_value('email') ?>"
                                    placeholder="Example-mail@mail.com">
                                <div class="invalid-feedback" id="email-invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md">
                            <div class="input-group has-validation">
                                <span class="input-group-text">
                                    <i class="bi bi-telephone-fill"></i>
                                </span>
                                <input type="tel" class="form-control" name="numero" id="numero"
                                    value="<?php echo $form->get_input_value('numero') ?>"
                                    placeholder="*Numero di telefono" required>
                                <div class="invalid-feedback" id="numero-invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col">
                            <label for="compleanno">Data di Nascita:</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">
                                    <i class="bi bi-gift-fill"></i>
                                </span>
                                <input type="date" class="form-control" name="compleanno" id="compleanno"
                                    value="<?php echo $form->get_input_value('compleanno') ?>">
                            </div>
                        </div>
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

    <script>
    function changeProfileImage() {
        const imageUrl = "<?php echo $form->get_input_value('immagine_contatto'); ?>";

        if (imageUrl) {
            const cssImgUrl = `url(${imageUrl})`;
            $(".profile-pic").css("background-image", cssImgUrl);
        }
    };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>