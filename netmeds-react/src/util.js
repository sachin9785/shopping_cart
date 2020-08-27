
export const validateForm = (formObject, requiredFields) => {
  let formError = {};

  [...formObject].forEach(element => {
    
    if ((element.value.trim().length === 0 || element.selectedIndex === 0) &&
      requiredFields[element.name] !== null
    ) {
      formError[element.name] = "The field can not be empty.";
    }
  })

  return validateEmail(formObject.email.value, formError);
}

export const validateEmail = (email, formError = {}) => {
  let lastAtPos = email.lastIndexOf('@');
  let lastDotPos = email.lastIndexOf('.');
  let emailLenght = email.length - lastDotPos;

  if (!(
    lastAtPos < lastDotPos &&
    lastAtPos > 0 &&
    email.indexOf('@@') === -1 &&
    lastDotPos > 2 &&
    emailLenght > 2
  )) {
    formError['email'] = "Please enter valid email address.";
  }

  return formError;
}

export const isEmpty = value =>
  value === undefined ||
  value === null ||
  (typeof value === 'object' && Object.keys(value).length === 0) ||
  (typeof value === 'string' && value.trim().length === 0);

  export const encodeForm = (data) => {
    return Object.keys(data)
      .map((key) => encodeURIComponent(key) + "=" + encodeURIComponent(data[key]))
      .join("&");
  };

export default function formatCurrency(num) {
  return "$" + Number(num.toFixed(1)).toLocaleString() + " ";
}




