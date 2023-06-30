export default class DefaultValidation {
    allInputsIds = [];
    inputsIdsToValidate;

    constructor(inputsIdsToValidate) {
        if (!inputsIdsToValidate) {
            const allInputs = $("input").not("[type='hidden']");

            for (let i = 0; i < allInputs.length; i++) {
                const inputId = allInputs[i].id;
                this.allInputsIds.push(inputId);
            }
        }
        this.inputsIdsToValidate = inputsIdsToValidate || this.allInputsIds;
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