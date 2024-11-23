// İNDEX.PHP DOSYASINDA TANITIM KISMI 

document.addEventListener('DOMContentLoaded', function () {
    var thumbnail = document.getElementById('videoThumbnail');
    var modal = document.getElementById('videoModal');
    var closeButton = document.querySelector('.close');
    var videoFrame = document.getElementById('videoFrame');

    var videoURL = 'https://www.youtube.com/embed/BBMwUDFxWhU';

    thumbnail.onclick = function () {
        modal.style.display = 'block';
        videoFrame.src = videoURL;
    };

    closeButton.onclick = function () {
        modal.style.display = 'none';
        videoFrame.src = '';
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            videoFrame.src = '';
        }
    };
});
