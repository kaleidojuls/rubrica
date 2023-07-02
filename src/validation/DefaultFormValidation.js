export default class DefaultValidation {
    inputsConfig;

    constructor(inputsConfig) {
        this.inputsConfig = inputsConfig;
    }

    activate() {
        for (const input in this.inputsConfig) {
            const inputId = this.inputsConfig[input].nameId;
            $(`#${inputId}`).change(() => this.defaultInputValidation(inputId));
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