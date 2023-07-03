import Input from "./Input.js";
import InputValidation from "./validation/InputValidation.js";
import ValidationMethods from "./validation/ValidationMethods.js";

const inputsConfig = {
    configImmagineContatto: new Input({
        type: "file",
        nameId: "immagine_contatto",
        customValidation: new InputValidation(ValidationMethods.isImgValid, "Il file deve essere un'immagine jpeg/jpg o png", "immagine aggiunta!")
    }),

    configNome: new Input({
        type: "text",
        nameId: "nome",
        placeholder: "*Nome",
        required: true,
        hasFeedbackBox: true,
        icon: "bi-person-fill",
        customValidation: new InputValidation(ValidationMethods.isStringValid, "Il campo deve avere tra i 2 e i 20 caratteri e non deve contenere numeri o caratteri speciali")
    }),

    configCognome: new Input({
        type: "text",
        nameId: "cognome",
        placeholder: "Cognome",
        hasFeedbackBox: true,
        customValidation: new InputValidation(ValidationMethods.isStringValid, "Il campo deve avere tra i 2 e i 20 caratteri e non deve contenere numeri o caratteri speciali")
    }),

    configSocieta: new Input({
        type: "text",
        nameId: "societa",
        placeholder: "Società",
        hasFeedbackBox: true,
        icon: "bi-briefcase-fill"
    }),

    configQualifica: new Input({
        type: "text",
        nameId: "qualifica",
        placeholder: "Qualifica",
        hasFeedbackBox: true
    }),

    configEmail: new Input({
        type: "email",
        nameId: "email",
        placeholder: "*Example.mail@email.com",
        required: true,
        hasFeedbackBox: true,
        icon: "bi-envelope-fill"
    }),

    configNumero: new Input({
        type: "tel",
        nameId: "numero",
        placeholder: "*Numero di telefono",
        required: true,
        hasFeedbackBox: true,
        icon: "bi-telephone-fill",
        customValidation: new InputValidation(ValidationMethods.isNumberValid, "Il numero deve avere un formato consentito")
    }),

    configCompleanno: new Input({
        type: "date",
        nameId: "compleanno",
        hasFeedbackBox: true,
        icon: "bi-gift-fill"
    }),
};

export default inputsConfig;

