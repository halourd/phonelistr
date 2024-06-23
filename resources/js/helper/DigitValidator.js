
export function validateNumber(input){
    input = input.replace(/[^0-9+]/g, '')
    return input;
}