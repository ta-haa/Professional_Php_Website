<?php
////SESSİON KONTROL DOSYASI
///////////////////////////////////////////////////SESSİON VE COOKİE TOKEN KONTROL
///////////////////////////////////////////////////EĞER TOKEN SQLDEKİ İLE DENK İSE ADMİN PANELDEKİ JAVASCRİPT KODLARI ÇALIŞIYOR
////BURDAKİ AMAÇ EĞER ADMİN KISMINA İZİNSİZ ERİŞİM SAĞLANIRSA BUNU ENGELLEMEK
//BU KODU ADMİNPANEL.PHP DOSYASI ÇEKİYOR

session_start(); // Oturumu başlatmak gerekiyor

include("./../connect.php");
if (isset($_SESSION['Gemail']) && isset($_SESSION['token'])) {


    $Semail = $_SESSION['Gemail'];
    $token = $_SESSION['token'];
    
    $stmt = $con->prepare("SELECT eposta, token, yetki FROM doner WHERE eposta = ? AND token = ? AND yetki = 1");
        $stmt->bind_param("ss", $Semail, $token);
        $stmt->execute();
        $sonucflip = $stmt->get_result();


        if ($sonucflip->num_rows > 0) { 

echo "

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Menü açma ve kapama işlevi
    document.querySelector('.toggle-button').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('mainContent').classList.toggle('shift');
    });

    // Butonlara tıklama olaylarını ekle
    document.querySelectorAll('.sidebar button').forEach(function (button) {
        button.addEventListener('click', function () {
            var sectionId = button.getAttribute('data-section');
            showContent(sectionId);
        });
    });

    function showContent(sectionId) {
        document.querySelectorAll('.content-section').forEach(function (section) {
            section.classList.remove('active');
        });

        var selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.classList.add('active');
        }

        if (sectionId === 'users') {
            loadUsers();
        } else if (sectionId === 'messages') {
            loadMessages();
        }
    }

    function loadUsers() {
        fetch('./kullanicilar/kullanici.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('users-content').innerHTML = data;

                // Silme butonlarına olay dinleyicilerini ekle
                document.querySelectorAll('.delete-user-form').forEach(form => {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();

                        const userId = this.getAttribute('data-id');

                        fetch('./kullanicilar/kullanicisil.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                id: userId
                            })
                        })
                            .then(response => response.json())
                            .then(result => {
                                if (result.success) {
                                    loadUsers(); // Kullanıcıları yeniden yükle
                                } else {
                                    alert('Silme işlemi sırasında bir hata oluştu: ' + result.error);
                                }
                            })
                            .catch(error => {
                                console.error('Hata:', error);
                            });
                    });
                });


                // Silme butonlarına olay dinleyicilerini ekle
                document.querySelectorAll('.yetki-user-form').forEach(form => {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();

                        const userId = this.getAttribute('data-id');

                        fetch('./kullanicilar/yetkiver.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                id: userId
                            })
                        })
                            .then(response => response.json())
                            .then(result => {
                                if (result.success) {
                                    loadUsers(); // Kullanıcıları yeniden yükle
                                } else {
                                    alert('Yetki işlemi sırasında bir hata oluştu: ' + result.error);
                                }
                            })
                            .catch(error => {
                                console.error('Hata:', error);
                            });
                    });
                });



            });
    }


    function loadMessages() {
        fetch('./mesajlar/mesaj.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('messages-content').innerHTML = data;

                // Silme butonlarına olay dinleyicilerini ekle
                document.querySelectorAll('.btndeletemesaj').forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();

                        const form = this.closest('form');
                        const formData = new FormData(form);

                        // Silme işlemini fetch ile yap
                        fetch('./mesajlar/mesajsil.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.text())
                            .then(result => {
                                if (result.includes('HATA')) {
                                    alert('Silme işlemi sırasında bir hata oluştu.');
                                } else {
                                    loadMessages(); // Mesajları yeniden yükle
                                }
                            })
                            .catch(error => {
                                console.error('Hata:', error);
                            });
                    });
                });
            });
    }

});


</script>

";                    
        }



        else {
            echo ' YETKİNİZ YOK ! ';
            echo '<script>window.location.href = "./../login/logout.php";</script>';
        }
 
    $stmt->close();
    $con->close(); 

} else { 
    echo ' YETKİNİZ YOK !'; 
    echo '<script>window.location.href = "./../login/logout.php";</script>';
}

?>