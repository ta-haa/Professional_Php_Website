<?php  
///////////////////////////////////Doner İletişim Kısmı
///BU KISMI İNDEX.PHP KISMI ÇEKİYOR 
include("./connect.php");

if (isset($_POST["contactgonder"])) {

    $contactname = $_POST["contactname"]; 
    $contactemail = $_POST["contactemail"]; 
    $contactmesaj = $_POST["contactmesaj"]; 

    // E-posta doğrulaması
    if (!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
        echo '<script> document.getElementById("contacthata").innerHTML="Geçersiz email formatı"; </script>';
        exit();
    }

    // Giriş yapma kontrolü
    if (isset($_SESSION['Gemail'])) {
 
        // Veritabanına mesajı ekleme
        $stmt = $con->prepare("INSERT INTO donercontact (contactad, contactemail, contactmesaj) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $contactname, $contactemail, $contactmesaj);

        if ($stmt->execute()) {
            echo '<script> document.getElementById("contacthata").innerHTML="Mesaj Başarıyla Gönderildi"; </script>';
        } else {
            echo '<script> document.getElementById("contacthata").innerHTML="Mesaj Gönderilemedi"; </script>';
        }

        $stmt->close(); 
    } else { 
        echo '<script> document.getElementById("contacthata").innerHTML="Lütfen Önce Giriş Yapınız"; </script>'; 
    }  

    $con->close(); 

} 

?>