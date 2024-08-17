// Initialize the intl-tel-input plugin
const input = document.querySelector("#phone");
const iti = window.intlTelInput(input, {
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js"
});
