import DefaultValidation from './DefaultFormValidation.js';

export default class CustomValidation extends DefaultValidation {
    constructor(inputsIdsToValidate) {
        super(inputsIdsToValidate);
    }

    validationOnChange() {
        this.inputsIdsToValidate.forEach(inputId => {
            $(`#${inputId}`).change(() => this.customInputValidation(inputId));
        });
    }

    isImgValid(inputValue) {
        const validRegExp = new RegExp(/\.(jpg|jpeg|png)$/);
        return validRegExp.test(inputValue);
    }

    isStringValid(inputValue) {
        const simpleValue = inputValue.toLowerCase().trim().split(" ").join("");
        const validRegExp = new RegExp(/^[a-z]{2,20}$/);
        return validRegExp.test(simpleValue);
    }

    isNumberValid(inputValue) {
        const validRegExp = new RegExp(/^((00|\+)39[\. ]?)?3\d{2}[\. ]?\d{6,7}$/);
        return validRegExp.test(inputValue);
    }

    setInputValidity(inputId, { validityFunction, invalidMessage, validMessage }) {
        const inputDocElement = document.getElementById(inputId);
        const myInputValue = inputDocElement.value;

        if (validityFunction(myInputValue)) {
            this.validateInput(inputId);
            inputDocElement.setCustomValidity("");
            $(`#${inputId}-invalid-feedback`).html(`<span style="color: green;">${validMessage}</span>`);

        } else {
            this.invalidateInput(inputId);
            inputDocElement.setCustomValidity(invalidMessage);
            $(`#${inputId}-invalid-feedback`).text(inputDocElement.validationMessage);
        }
    }

    customInputValidation(inputId) {
        switch (inputId) {
            case "immagineContatto":
                const imgFakePath = document.getElementById(inputId).value.split("\\");

                const imgValidation = {
                    validityFunction: this.isImgValid,
                    invalidMessage: "Il file deve essere un'immagine jpeg/jpg o png",
                    validMessage: `${imgFakePath[imgFakePath.length - 1]}`,
                }
                this.setInputValidity(inputId, imgValidation);
                break;

            case "nome":
            case "cognome":
                const stringValidation = {
                    validityFunction: this.isStringValid,
                    invalidMessage: "Il campo deve avere tra i 2 e i 20 caratteri e non deve contenere numeri o caratteri speciali",
                    validMessage: "",
                }
                this.setInputValidity(inputId, stringValidation);
                break;

            case "numero":
                const numberValidation = {
                    validityFunction: this.isNumberValid,
                    invalidMessage: "Il numero deve avere un formato consentito",
                    validMessage: "",
                }
                this.setInputValidity(inputId, numberValidation);
                break;

            default:
                this.defaultInputValidation(inputId);
        }
    }
}
