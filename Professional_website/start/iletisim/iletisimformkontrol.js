/* İNDEX.PHP DOSYASINDA LOGİN KAYIT KISMI */

document.getElementById('contact-form').addEventListener('submit', function (event) {

    //Bot tespit gizli input textbox eğer değeri değişirse submit etmez
    const hiddenField = document.querySelector('input[name="gizli_contact"]');
    if (hiddenField.value !== 'Teka1453') {
        event.preventDefault();
        console.log("Bot Tespit Edildi.");
        return;
    }

    const iletisimad = document.getElementById('iletisimad').value;
    const iletisimmesaj = document.getElementById('iletisimmesaj').value;
    const warning = document.getElementById('contacthata');

    warning.textContent = '';

    // Boşluk karakteri kontrolü
    if (/\s/.test(iletisimad) || /\s/.test(iletisimmesaj)) {
        warning.textContent += 'Form boşluk içermemeli. ';
    } else {
        // Özel karakter kontrolü
        const hasSpecialCharad = /[!@#$%^&*(),.?":{}|<>]/.test(iletisimad);
        const hasSpecialCharmesaj = /[!@#$%^&*(),.?":{}|<>]/.test(iletisimmesaj);

        if (hasSpecialCharad) {
            warning.textContent += 'İletişim adında sembol olmamalı. ';
        }
        if (hasSpecialCharmesaj) {
            warning.textContent += 'Mesajda sembol olmamalı. ';
        }
    }

    // Uyarı varsa formun gönderilmesini engelle
    if (warning.textContent) {
        event.preventDefault(); // Formun gönderilmesini engelle
    }
});


