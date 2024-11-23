/* İNDEX.PHP DOSYASINDA LOGİN KAYIT KISMI */

document.getElementById('kayit-form').addEventListener('submit', function (event) {

    //Bot tespit gizli input textbox eğer değeri değişirse submit etmez
    const hiddenField = document.querySelector('input[name="gizli_kayit"]');
    if (hiddenField.value !== 'Teka1453') {
        event.preventDefault();
        console.log("Bot Tespit Edildi.");
        return;
    }

    const password = document.getElementById('kayit-password').value;
    const mail = document.getElementById('kayit-mail').value;
    const warning = document.getElementById('kayithata');

    warning.textContent = '';

    // E-posta ve şifrede boşluk karakteri kontrolü 
    if (/\s/.test(mail) || /\s/.test(password)) {

        warning.textContent += 'E-posta veya şifre boşluk içermemeli. ';
    } else {
        // Şifre kontrolü
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasDigit = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        if (!hasUpperCase) {
            warning.textContent += 'Şifrede büyük harf olmalı. ';
        }
        if (!hasLowerCase) {
            warning.textContent += 'Şifrede küçük harf olmalı. ';
        }
        if (!hasDigit) {
            warning.textContent += 'Şifrede rakam olmalı. ';
        }
        if (!hasSpecialChar) {
            warning.textContent += 'Şifrede sembol olmalı. ';
        }
    }

    // Uyarı varsa formun gönderilmesini engelle
    if (warning.textContent) {
        event.preventDefault(); // Formun gönderilmesini engelle
    }


});

