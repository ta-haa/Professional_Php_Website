<?php
////EPOSTA DOĞRULAMA VERİFY.PHP DOSYASI
///////////////////////////////////////////////////İNDEX.PHP KISMINDA 2 YER BUNU ÇEKİYOR 
//////////////////////ÜYELİK VE GİRİŞ YAPTIKTAN SONRAKİ ONAYLANMAMIŞ EPOSTA OLAN HESAPLAR


include("./../connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './../phpmailer/src/Exception.php';
require './../phpmailer/src/PHPMailer.php';
require './../phpmailer/src/SMTP.php'; 

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Token'ı veri tabanında karşılaştırmak için hash'leme yerine doğrudan karşılaştırma yapıyoruz.
    $stmt = $con->prepare("SELECT * FROM doner WHERE captcha = ? AND captchaexpiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token geçerli
        echo "E-posta doğrulandı!";

        // Token'ı null yap
        $stmt = $con->prepare("UPDATE doner SET captcha = NULL, captchaexpiry = NULL, verification = 1 WHERE captcha = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        echo '<script>window.location.href = "./../index.php";</script>';
 
    } else {
        echo "Geçersiz veya süresi dolmuş token.";
    }

    $stmt->close();
} else {
    echo "Geçersiz istek.";
}

$con->close();
?>
 