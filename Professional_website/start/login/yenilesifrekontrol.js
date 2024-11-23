/* BU DOSYAYI SİFREYENİLE.PHP DOSYASI ÇEKİYOR */
/* LOGİN ŞİFRE UNUTTUM KISMINDAKİ YENİ ŞİFRE */

document.getElementById('sifreyenile').addEventListener('submit', function (event) {
    const password = document.getElementById('yenile-password').value;
    const confirmPassword = document.getElementById('yenile-password-tekrar').value;
    const warning = document.getElementById('yenilehata');

    warning.textContent = ''; // Clear previous warnings

    // Check if password is empty or contains spaces   
    if (!password || /\s/.test(password)) {
        warning.textContent += 'Şifre boş olmamalı ve boşluk içermemelidir. ';
    } else {
        // Password criteria checks
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
        if (password !== confirmPassword) {
            warning.textContent += 'Şifreler birbirini doğrulamıyor. ';
        }

        if (warning.textContent) {
            event.preventDefault(); // Prevent form submission if there are warnings
        }
    }
});


