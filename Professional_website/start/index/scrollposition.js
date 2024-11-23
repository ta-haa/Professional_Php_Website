/* İNDEX.PHP DOSYASINDAKİ MOUSE GEÇİŞ EFEKTİ scroll behavior smooth */

const scrollPositions = [0, 800, 1500, 2200, 3000, 3700, 4500, 5300, 6200, 6800];
let currentIndex = 0;
let isScrolling = false;

function news() {
    scrollPositions[scrollPositions.length - 1] = 500;

    const newIndex = scrollPositions.indexOf(800);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function hakkinda() {
    scrollPositions[scrollPositions.length - 1] = 800;

    const newIndex = scrollPositions.indexOf(1500);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function tanitim() {
    scrollPositions[scrollPositions.length - 1] = 500;

    const newIndex = scrollPositions.indexOf(2200);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function worker() {
    scrollPositions[scrollPositions.length - 1] = 500;

    const newIndex = scrollPositions.indexOf(3000);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function menu() {
    scrollPositions[scrollPositions.length - 1] = 500;

    const newIndex = scrollPositions.indexOf(3700);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function whatwedo() {
    scrollPositions[scrollPositions.length - 1] = 4550;

    const newIndex = scrollPositions.indexOf(4550);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function gallery() {
    scrollPositions[scrollPositions.length - 1] = 5400;

    const newIndex = scrollPositions.indexOf(5400);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function iletisim() {
    scrollPositions[scrollPositions.length - 1] = 6210;

    const newIndex = scrollPositions.indexOf(6210);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function sss() {
    scrollPositions[scrollPositions.length - 1] = 6800;

    const newIndex = scrollPositions.indexOf(6900);


    if (document.documentElement.scrollHeight > 6900) {
        smoothScrollTo(6900);
    }

}
function line1tanitim() {
    scrollPositions[scrollPositions.length - 1] = 500;

    const newIndex = scrollPositions.indexOf(2200);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}


function line2tanitim() {
    scrollPositions[scrollPositions.length - 1] = 6210;

    const newIndex = scrollPositions.indexOf(6210);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function line3galeri() {
    scrollPositions[scrollPositions.length - 1] = 5400;

    const newIndex = scrollPositions.indexOf(5400);

    if (newIndex !== -1) {
        currentIndex = newIndex;
        smoothScrollTo(scrollPositions[currentIndex]);
    }
}

function smoothScrollTo(position) {
    if (isScrolling) return;
    isScrolling = true;

    const start = window.scrollY;
    const distance = position - start;
    const startTime = performance.now();
    const duration = 1000;

    function scrollStep(timestamp) {
        const elapsed = timestamp - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easeInOut = (t) => t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
        window.scrollTo(0, start + distance * easeInOut(progress));
        if (elapsed < duration) {
            requestAnimationFrame(scrollStep);
        } else {
            isScrolling = false;
        }
    }

    requestAnimationFrame(scrollStep);
}



function checkScrollPosition() {
    const scrollY = window.scrollY;

    scrollPositions.forEach((pos, index) => {
        const nextPos = scrollPositions[index + 1] || Infinity;
        const isVisible = scrollY >= pos && scrollY < nextPos;

        if (index < 10) {
            document.querySelectorAll(`.fade-p${index + 1}`).forEach(el => {
                if (isVisible) el.classList.add('show');
                else el.classList.remove('show');
            });
        }
    });
}

window.addEventListener('scroll', checkScrollPosition);

window.addEventListener('wheel', function (event) {
    if (event.deltaY > 0) {
        if (currentIndex < scrollPositions.length - 1) {
            currentIndex++;
            smoothScrollTo(scrollPositions[currentIndex]);
        }
    } else {
        if (currentIndex > 0) {
            currentIndex--;
            smoothScrollTo(scrollPositions[currentIndex]);
        }
    }
});

var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
    modal.style.display = "block";
}

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
