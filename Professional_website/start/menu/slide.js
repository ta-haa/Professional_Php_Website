// İNDEX.PHP DOSYASINDA MENU KISMI 

let slideIndex = 0;
let slideInterval;

const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function showSlide(index) {
    if (index >= slides.length) { slideIndex = 0; }
    if (index < 0) { slideIndex = slides.length - 1; }

    slides.forEach((slide, i) => {
        slide.style.display = i === slideIndex ? 'block' : 'none';
        slide.style.opacity = i === slideIndex ? '1' : '0';
    });

    dots.forEach((dot, i) => {
        dot.className = i === slideIndex ? 'dot active' : 'dot';
    });
}

function nextSlide() {
    slideIndex++;
    showSlide(slideIndex);
}

function prevSlide() {
    slideIndex--;
    showSlide(slideIndex);
}

function currentSlide(index) {
    slideIndex = index;
    showSlide(slideIndex);
}

function startSlideInterval() {
    slideInterval = setInterval(nextSlide, 2000);
}

function pauseSlide() {
    clearInterval(slideInterval);
}

function resumeSlide() {
    startSlideInterval();
}

showSlide(slideIndex);
startSlideInterval();