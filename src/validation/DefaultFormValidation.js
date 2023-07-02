export default class DefaultValidation {
    inputsConfig;

    constructor(inputsConfig) {
        this.inputsConfig = inputsConfig;

        for (const input in inputsConfig) {
            if (!inputsConfig[input].customValidation) {
                inputsConfig[input].validationOnChange(this.defaultInputValidation);
            }
        };
    }

    invalidateInput(inputId) {
        const jQueryInputId = `#${inputId}`;
        if ($(jQueryInputId).hasClass("is-valid")) {
            $(jQueryInputId).removeClass("is-valid")
        }
        $(jQueryInputId).addClass("is-invalid")
    }

    validateInput(inputId) {
        const jQueryInputId = `#${inputId}`;
        if ($(jQueryInputId).hasClass("is-invalid")) {
            $(jQueryInputId).removeClass("is-invalid")
        }
        $(jQueryInputId).addClass("is-valid")
    }

    defaultInputValidation(inputId) {
        const inputDocElement = document.getElementById(inputId);
        const inputElementValidity = inputDocElement.checkValidity();

        if (!inputElementValidity) {
            this.invalidateInput(inputId);
            $(`#${inputId}-invalid-feedback`).text(inputDocElement.validationMessage);
        } else {
            this.validateInput(inputId);
        }
    }

}