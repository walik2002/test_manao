import AjaxRequester from './AjaxRequester.js';
import DomManipulator from './DomManipulator.js';

class AjaxForm {
  constructor(formContainerId, ajaxUrl) {
    this.formContainer = document.getElementById(formContainerId);
    this.ajaxUrl = ajaxUrl;
    this.form = null;
    this.ajaxRequester = new AjaxRequester(ajaxUrl);
  }

  loadForm() {
    this.ajaxRequester.get((responseText) => {
      this.formContainer.innerHTML = responseText;
      this.form = this.formContainer.querySelector('form');
      this.form.addEventListener('submit', this.handleSubmit.bind(this));
    });
  }

  handleSubmit(event) {
    event.preventDefault();
    const formData = new FormData(this.form);
    const domManipulator = new DomManipulator(this.form.id);
    domManipulator.clearErrors();

    this.ajaxRequester.post(formData, (data, textStatus, jqXHR) => {
      try {
        if (JSON.parse(data).redirect) {
          window.location.href = JSON.parse(data).redirect;
          return;
        }
      } catch {}

      this.formContainer.innerHTML = jqXHR.responseText;
      this.form = null;
    }, (jqXHR, textStatus, errorThrown) => {
      if (jqXHR.status === 406) {
        const errors = JSON.parse(jqXHR.responseText);
        domManipulator.showFieldErrors(errors);
      } else if (jqXHR.status === 400) {
        domManipulator.showError(jqXHR.responseText);
      }
    });
  }
}

export default AjaxForm;
