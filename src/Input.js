export default class Input {

    type;
    nameId;
    placeholder;
    value;
    required;
    hasFeedbackBox;
    hasIcon;
    iconName;
    customValidation;

    constructor(type = "text", nameId = "", placeholder = false, value = false, required = false, hasFeedbackBox = false, hasIcon = false, iconName = "", customValidation = false) {
        this.type = type;
        this.nameId = nameId;
        this.placeholder = placeholder;
        this.value = value;
        this.required = required;
        this.hasFeedbackBox = hasFeedbackBox;
        this.hasIcon = hasIcon;
        this.iconName = iconName;
        this.customValidation = customValidation;
    }

    validationOnChange($validationFunction) {
        if (this.customValidation) {
            $(`#${this.nameId}`).change(() => $validationFunction(this.nameId, this.customValidation));
        } else {
            $(`#${this.nameId}`).change(() => $validationFunction(this.nameId));
        }
    }

    printInput() {
        const hasIcon = this.hasIcon ?
            `<span class="input-group-text">
            <i class="bi ${this.iconName}"></i>
            </span>` : "";
        const hasPlaceholder = this.placeholder ? ` placeholder="${this.placeholder}"` : "";
        const hasValue = this.value ? ` value="${this.value}"` : "";
        const hasFeedbackBox = this.hasFeedbackBox ?
            `<div class="invalid-feedback" id="${this.nameId}-invalid-feedback"></div>` :
            "";
        const isRequired = this.required ? ` required"` : "";

        let inputHTML = `${hasIcon}` +
            `<input` +
            ` type="${this.type}"` +
            ` id="${this.nameId}"` +
            ` name="${this.nameId}"` +
            ` class="form-control"` +
            `${hasPlaceholder}` +
            `${hasValue}` +
            `${isRequired}>` +
            `${hasFeedbackBox}`;

        if (this.hasIcon) {
            inputHTML = `<div class="input-group has-validation"> ${inputHTML} </div>`;
        };

        $(`#col-${this.nameId}`).html(inputHTML);
    }

}