/* İNDEX.PHP DOSYASINDA LOGİN KISMI PANEL AÇILMASI VE KAPANMASI */

document.addEventListener('DOMContentLoaded', () => {
    const togglePanelButton = document.getElementById('toggle-panel-button');
    const closePanelButton = document.getElementById('close-panel-button');
    const lgnoverlay = document.getElementById('lgnoverlay');
    const lgnpanel = document.getElementById('lgnpanel');
    const toggleFormButton = document.getElementById('toggle-form-button');
    const signupContainer = document.getElementById('signup-container');
    const loginContainer = document.getElementById('login-container');
    const signupForm = document.getElementById('signup-form');
    const loginForm = document.getElementById('kayit-form');
    const messageDiv = document.getElementById('message');

    const unuttumpanel = document.getElementById('dvsifreunuttum');

    togglePanelButton.addEventListener('click', () => {
        lgnpanel.classList.add('active');
        lgnoverlay.style.display = 'block';
    });

    closePanelButton.addEventListener('click', () => {
        lgnpanel.classList.remove('active');
        lgnoverlay.style.display = 'none';

        //sifre unuttum formu
        unuttumpanel.classList.remove('active');
        unuttumpanel.style.display = 'none';

    });

    lgnoverlay.addEventListener('click', () => {
        lgnpanel.classList.remove('active');
        lgnoverlay.style.display = 'none';
    });

    toggleFormButton.addEventListener('click', () => {
        if (signupContainer.style.display === 'none') {
            signupContainer.style.display = 'block';
            loginContainer.style.display = 'none';
            toggleFormButton.textContent = ' Giriş Yap';
        } else {
            signupContainer.style.display = 'none';
            loginContainer.style.display = 'block';
            toggleFormButton.textContent = 'Geri';
        }
    });

});
