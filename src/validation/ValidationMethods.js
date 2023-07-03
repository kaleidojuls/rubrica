export default class ValidationMethods {

    static isImgValid(inputValue) {
        const validRegExp = new RegExp(/\.(jpg|jpeg|png)$/);
        return validRegExp.test(inputValue);
    };

    static isStringValid(inputValue) {
        const simpleValue = inputValue.toLowerCase().trim().split(" ").join("");
        const validRegExp = new RegExp(/^[a-z]{2,20}$/);
        return validRegExp.test(simpleValue);
    };

    static isNumberValid(inputValue) {
        const validRegExp = new RegExp(/^((00|\+)39[\. ]?)?3\d{2}[\. ]?\d{6,7}$/);
        return validRegExp.test(inputValue);
    };

}