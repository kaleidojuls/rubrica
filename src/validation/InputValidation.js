export default class InputValidation {

    validityFunction;
    invalidMessage;
    validMessage;

    constructor(validityFunction, invalidMessage = "", validMessage = "") {
        this.validityFunction = validityFunction;
        this.invalidMessage = invalidMessage;
        this.validMessage = validMessage;
    }

}