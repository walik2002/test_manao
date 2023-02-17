class DomManipulator {
    constructor(containerId) {
      this.container = document.getElementById(containerId);
    }
  
    showForm(formHtml) {
      this.container.innerHTML = formHtml;
    }
  
    clearErrors() {
      let errors = document.querySelectorAll('.error');
      errors.forEach(error => {
        error.innerHTML = '';
      });
    }
  
    showError(errorMessage) {
      let errorMessageElement = document.querySelector('#error-message');
      errorMessageElement.textContent = errorMessage;
    }
  
    showFieldErrors(errorFields) {
      for (const field in errorFields) {
        const errorElement = document.getElementById(field + '-error');
        errorElement.innerHTML = errorFields[field];
      }
    }

    static clearErrors(){
        let errors = document.querySelectorAll('.error');
        errors.forEach(error => {
          error.innerHTML = '';
        });
    }
  }
  export default DomManipulator;