/* Main javascript */




window.onload = function() {
var ModalContainer = document.getElementById("ModalContainer");

var SignUpModal = document.getElementById("SignUpContainer");

var SignInModal = document.getElementById("SignInContainer");

var SignUpButton = document.getElementById("SignUp");

var SignInButton = document.getElementById("SignIn");



SignUpButton.onclick = function() {
    SignUpModal.style.display = "block";
    ModalContainer.style.display = "block";
}


SignInButton.onclick = function() {
    SignInModal.style.display = "block";
    ModalContainer.style.display = "block";
}

window.onclick = function(event) {
    if(event.target == ModalContainer) {
        ModalContainer.style.display = "none";
        SignInModal.style.display = "none";
        SignUpModal.style.display = "none";
    }
}

}
