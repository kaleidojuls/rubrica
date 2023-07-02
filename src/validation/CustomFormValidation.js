import DefaultValidation from './DefaultFormValidation.js';

export default class CustomValidation extends DefaultValidation {
    constructor(inputsConfig) {
        super(inputsConfig);
    }

    activateCustom() {
        for (const input in this.inputsConfig) {
            const inputId = this.inputsConfig[input].nameId;
            const customValidation = this.inputsConfig[input].customValidation;

            if (customValidation) {
                $(`#${inputId}`).change(() => this.customInputValidation(inputId, customValidation));
            } else {
                $(`#${inputId}`).change(() => this.defaultInputValidation(inputId));
            }
        };
    }

    customInputValidation(inputId, { validityFunction, invalidMessage, validMessage }) {
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

}
