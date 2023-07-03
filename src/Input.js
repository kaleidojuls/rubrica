export default class Input {

    type;
    nameId;
    placeholder = false;
    value = false;
    required = false;
    hasFeedbackBox = false;
    icon = false;
    customValidation = false;

    constructor({ type, nameId, placeholder, value, required, hasFeedbackBox, icon, customValidation }) {
        this.type = type;
        this.nameId = nameId;
        this.placeholder = placeholder;
        this.value = value;
        this.required = required;
        this.hasFeedbackBox = hasFeedbackBox;
        this.icon = icon;
        this.customValidation = customValidation;
    }

    printInput() {
        const hasPlaceholder = this.placeholder ? ` placeholder="${this.placeholder}"` : "";
        const hasValue = this.value ? ` value="${this.value}"` : "";
        const hasFeedbackBox = this.hasFeedbackBox ?
            `<div class="invalid-feedback" id="${this.nameId}-invalid-feedback"></div>` :
            "";
        const isRequired = this.required ? ` required"` : "";

        let inputHTML = `<input` +
            ` type="${this.type}"` +
            ` id="${this.nameId}"` +
            ` name="${this.nameId}"` +
            ` class="form-control"` +
            `${hasPlaceholder}` +
            `${hasValue}` +
            `${isRequired}>` +
            `${hasFeedbackBox}`;

        if (this.icon) {
            inputHTML = `<div class="input-group has-validation">
            <span class="input-group-text">
            <i class="bi ${this.icon}"></i>
            </span> 
            ${inputHTML} 
            </div>`;
        };

        $(`#col-${this.nameId}`).html(inputHTML);
    }

}