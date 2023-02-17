import DomManipulator from './DomManipulator.js';
import AjaxForm from './AjaxForm.js';

const authForm = new AjaxForm('form-container', 'modules\\authorizationForm.php');
const regForm = new AjaxForm('form-container', 'modules\\registrationForm.php');

document.getElementById('auth-btn').addEventListener('click', function() {
  DomManipulator.clearErrors();
  authForm.loadForm();
});

document.getElementById('reg-btn').addEventListener('click', function() {
  DomManipulator.clearErrors();
  regForm.loadForm();
});

authForm.loadForm();