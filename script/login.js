document.addEventListener('DOMContentLoaded', function () {

    const loginForm = document.forms['loginForm'];
    loginForm.addEventListener('submit', function (event) {
        const loginEmail = document.getElementById('login-email').value;
        const loginPassword = document.getElementById('login-password').value;

        if (!loginEmail || !loginPassword) {
            event.preventDefault();
            alert('Email dan Password harus diisi.');
        }
    });


    const registerForm = document.forms['registerForm'];
    registerForm.addEventListener('submit', function (event) {
        const registerEmail = document.getElementById('register-email').value;
        const registerPassword = document.getElementById('register-password').value;
        const registerConfirmPassword = document.getElementById('register-confirm-password').value;

        if (!registerEmail || !registerPassword || !registerConfirmPassword) {
            event.preventDefault();
            alert('Semua field harus diisi.');
        } else if (registerPassword !== registerConfirmPassword) {
            event.preventDefault();
            alert('Password dan Konfirmasi Password harus sama.');
        }
    });
});



