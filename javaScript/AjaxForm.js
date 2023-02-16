import AjaxRequester from './AjaxRequester.js';
import DomManipulator from './DomManipulator.js';

class AjaxForm {
    constructor(formContainerId, ajaxUrl) {
      this.formContainer = document.getElementById(formContainerId);
      this.ajaxUrl = ajaxUrl;
      this.form = null;
    }
  
    loadForm() {
      const ajaxRequester = new AjaxRequester(this.ajaxUrl);
      ajaxRequester.get((responseText) => {
        this.formContainer.innerHTML = responseText;
        this.form = this.formContainer.querySelector('form');
        this.form.addEventListener('submit', this.handleSubmit.bind(this));
      });
    }
  
    handleSubmit(event) {
      event.preventDefault();
      const ajaxRequester = new AjaxRequester(this.form.action);
      const formData = new FormData(this.form);
      const domManipulator = new DomManipulator(this.form.id);
      domManipulator.clearErrors();
      ajaxRequester.post(formData, (responseText) => {
        this.formContainer.innerHTML = responseText;
        this.form = null;
      },
      (status,responseText)=>{
        if(status ===406){
            const errors = JSON.parse(responseText);
            domManipulator.showFieldErrors(errors);
        }else if (status === 400) {
            domManipulator.showError(responseText);
        }
      });
    }
  }

  export default AjaxForm;