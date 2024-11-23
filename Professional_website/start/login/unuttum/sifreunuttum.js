/* İNDEX.PHP DOSYASINDA SİFRE UNUTTUM KISMI */

function sifreunuttum() {
    document.getElementById("dvsifreunuttum").style.display = "block";

    document.getElementById('login-container').style.display = "none";

}
const unuttumclose = document.getElementById('unuttumgeri');
const unuttumpanel = document.getElementById('dvsifreunuttum');

unuttumclose.addEventListener('click', () => {
    unuttumpanel.classList.remove('active');
    unuttumpanel.style.display = 'none';
});





/* BOT TESPİT KISMI */

document.getElementById('unuttum-form').addEventListener('submit', function (event) {

    //Bot tespit gizli input textbox eğer değeri değişirse submit etmez
    const hiddenField = document.querySelector('input[name="gizli_unuttum"]');
    if (hiddenField.value !== 'Teka1453') {
        event.preventDefault();
        console.log("Bot Tespit Edildi.");
        return;
    }



});

