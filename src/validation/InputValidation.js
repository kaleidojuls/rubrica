export default class InputValidation {

    validityFunction; //deve accettare nameId e customValidation (oggetto di input specifico);
    invalidMessage;
    validMessage;

    constructor(validityFunction, invalidMessage = "", validMessage = "") {
        this.validityFunction = validityFunction;
        this.invalidMessage = invalidMessage;
        this.validMessage = validMessage;
    }

}