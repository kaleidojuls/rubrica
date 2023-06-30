class CustomInputValidation {
    inputId;
    validityFunction;
    invalidMessage;
    validMessage;

    construct(inputId, validityFunction, invalidMessage, validMessage) {
        this.inputId = inputId;
        this.validityFunction = validityFunction;
        this.invalidMessage = invalidMessage;
        this.validMessage = validMessage;
    }
}