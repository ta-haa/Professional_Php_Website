 
<?php
////İP VE KONUM BİLGİSİ
///EĞER KULLANICI KONUM PAYLAŞ BİLGİSİNE EVET DERSE KONUM KLASÖRÜNÜN İÇİNDEKİ KONUM.PHP DOSYASINA YÖNLENDİRİYOR


// JavaScript kodu
echo "
<script>
    // Fetch IP address
    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            const ipAddress = data.ip; 

            // Get geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Send IP address and location data to the server
                    const xhr = new XMLHttpRequest();
        
                xhr.open('POST', './konum/konum.php', true);

                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('ip=' + encodeURIComponent(ipAddress) + 
                             '&latitude=' + encodeURIComponent(latitude) + 
                             '&longitude=' + encodeURIComponent(longitude));
                }, function (error) {
                    console.error('Error getting location:', error);
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
        });
</script>
";

?>
