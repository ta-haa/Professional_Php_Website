/* ADMİNPANEL.PHP DOSYASINDA ADMİN KISMI */
/* ADMİNPANEL.PHP DOSYASI ÇEKİYOR */

//powered by Taha
console.log("----------------------");
console.log("Ta-Ha");
console.log("----------------------");

//navigator online
setInterval(onoroff, 10000);
function onoroff() {
    if (navigator.onLine) {
        console.log("Online");
    } else {
        window.open("https://www.youtube.com/channel/UCbJFy2KTBclbYfcaQFKZapQ", "_self");
    }
}
setInterval("titletime ()", 1000)
var time = 0;
function titletime() {
    time++;
    if (time % 2 == 1) { document.title = "Welcome" }
    else { document.title = "Admin" }
}

setInterval("ok ()", 1000)
function ok() {
    if (document.hasFocus()) { }
    else { document.title = "Come Back"; }
    ;
}