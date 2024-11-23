/* İNDEX.PHP DOSYASINDA LOGİN KAYIT KISMI */

document.getElementById('giris-form').addEventListener('submit', function (event) {

    //Bot tespit gizli input textbox eğer değeri değişirse submit etmez
    const hiddenField = document.querySelector('input[name="gizli_giris"]');
    if (hiddenField.value !== 'Teka1453') {
        event.preventDefault();
        console.log("Bot Tespit Edildi.");
        return;
    }

    // Form elemanlarını al
    const password = document.getElementById('giris-password').value;
    const email = document.getElementById('giris-email').value;
    const warning = document.getElementById('message');

    // Uyarı metnini temizle
    warning.textContent = '';

    // Boşluk karakteri kontrolü 
    if (/\s/.test(email) || /\s/.test(password)) {
        warning.textContent += 'Eposta veya Şifre Boşluk İçeremez. ';
    } else {
        // Şifre kontrolü
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasDigit = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        if (!hasUpperCase) {
            //,warning.textContent += 'Şifrede büyük harf olmalı. ';
            warning.textContent += ' ';
        }
        if (!hasLowerCase) {
            //warning.textContent += 'Şifrede küçük harf olmalı. ';
            warning.textContent += ' ';
        }
        if (!hasDigit) {
            //warning.textContent += 'Şifrede rakam olmalı. ';
            warning.textContent += ' ';
        }
        if (!hasSpecialChar) {
            //warning.textContent += 'Şifrede sembol olmalı. ';
            warning.textContent += ' ';
        }

        // Uyarı varsa formu gönderme
        if (warning.textContent) {
            event.preventDefault(); // Formun gönderilmesini engelle
        }
    }
});

