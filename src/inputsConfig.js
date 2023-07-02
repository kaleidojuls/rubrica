import Input from "./Input.js";
import InputValidation from "./validation/InputValidation.js";

const inputsConfig = {
    configImmagineContatto: new Input(
        "file",
        "immagine_contatto",
        false,
        false,
        false,
        false,
        false,
        "",
        new InputValidation(isImgValid, "Il file deve essere un'immagine jpeg/jpg o png", "immagine aggiunta!")
    ),

    configNome: new Input(
        "text",
        "nome",
        "*Nome",
        false,
        true,
        true,
        true,
        "bi-person-fill",
        new InputValidation(isStringValid, "Il campo deve avere tra i 2 e i 20 caratteri e non deve contenere numeri o caratteri speciali")
    ),

    configCognome: new Input(
        "text",
        "cognome",
        "Cognome",
        false,
        false,
        true,
        false,
        "",
        new InputValidation(isStringValid, "Il campo deve avere tra i 2 e i 20 caratteri e non deve contenere numeri o caratteri speciali")
    ),

    configSocieta: new Input(
        "text",
        "societa",
        "Società",
        false,
        false,
        true,
        true,
        "bi-briefcase-fill",
        false
    ),

    configQualifica: new Input(
        "text",
        "qualifica",
        "Qualifica",
        false,
        false,
        true,
        false,
        "",
        false
    ),

    configEmail: new Input(
        "email",
        "email",
        "*Example.mail@email.com",
        false,
        true,
        true,
        true,
        "bi-envelope-fill",
        false
    ),

    configNumero: new Input(
        "tel",
        "numero",
        "*Numero di telefono",
        false,
        true,
        true,
        true,
        "bi-telephone-fill",
        new InputValidation(isNumberValid, "Il numero deve avere un formato consentito")
    ),

    configCompleanno: new Input(
        "date",
        "compleanno",
        false,
        false,
        false,
        true,
        true,
        "bi-gift-fill",
        null
    ),
};

function isImgValid(inputValue) {
    const validRegExp = new RegExp(/\.(jpg|jpeg|png)$/);
    return validRegExp.test(inputValue);
};

function isStringValid(inputValue) {
    const simpleValue = inputValue.toLowerCase().trim().split(" ").join("");
    const validRegExp = new RegExp(/^[a-z]{2,20}$/);
    return validRegExp.test(simpleValue);
};

function isNumberValid(inputValue) {
    const validRegExp = new RegExp(/^((00|\+)39[\. ]?)?3\d{2}[\. ]?\d{6,7}$/);
    return validRegExp.test(inputValue);
};

export default inputsConfig;

