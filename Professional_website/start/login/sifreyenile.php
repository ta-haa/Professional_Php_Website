<?php
////ŞİFRE YENİLEME DOSYASI
///////////////////////GİRİLEN EPOSTA SQL DE MEVCUTSA EPOSTAYA DOĞRULAMA KODU GÖNDER EĞER DOĞRULARSA ŞİFRE YENİLE 
/////KISMI AÇILIR VE ŞİFREYİ GÜNCELLER 
////BU DOSYAYI YALNIZCA İNDEX.PHP DEKİ ŞİFRE UNUTTUM KISMI ÇEKİYOR

include("./../connect.php");

function showMessage($message, $type = 'error') {
    $color = $type === 'error' ? 'red' : 'green';
    echo "<div style='color:$color'>$message</div>";
}

if (isset($_GET['token']) && isset($_GET['email'])) {
    $email = filter_var(trim($_GET['email']), FILTER_SANITIZE_EMAIL);
    $token = filter_var(trim($_GET['token']), FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showMessage('Geçersiz e-posta formatı.');
        exit();
    }

    // Check if the email and token are valid
    $stmt = $con->prepare("SELECT * FROM doner WHERE eposta = ? AND captcha = ? AND captchaexpiry > NOW()");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sifre = $_POST['Usifre'] ?? '';
            $sifre_tekrar = $_POST['Usifretekrar'] ?? '';

            if (empty($sifre) || empty($sifre_tekrar)) {
                showMessage('Şifreler boş olamaz.');
                exit();
            }

            // Check for spaces
            if (preg_match('/\s/', $sifre) || preg_match('/\s/', $sifre_tekrar)) {
                showMessage('Şifreler boşluk karakteri içermemelidir.');
                exit();
            }

            if ($sifre !== $sifre_tekrar) {
                showMessage('Şifreler uyuşmuyor.');
                exit();
            }

            if (strlen($sifre) < 8) {
                showMessage('Şifre en az 8 karakter olmalıdır.');
                exit(); 
            }

            // Şifre hashleme
            $salt = '@donerteka_';
            $hashed_password = hash('sha256', $sifre . $salt);

            // Update password
            $stmt = $con->prepare("UPDATE doner SET sifre = ?, captcha = NULL, captchaexpiry = NULL, verification = 1 WHERE eposta = ?");
            $stmt->bind_param("ss", $hashed_password, $email);

            if ($stmt->execute()) {
                showMessage('Şifreniz başarıyla güncellendi.', 'success');
                echo '<script>window.location.href = "./../index.php";</script>';
            } else {
                showMessage('Şifre güncellenirken bir hata oluştu: ' . $stmt->error);
                echo '<script>window.location.href = "./../index.php";</script>';
            }
        } else {
            echo '<style>
            body{
            margin:0;
            padding:0;
            overflow-y: hidden;
            overflow-x: hidden;
            background: #1e1e1e; 
            font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
            }
.sifreunuttum {  
     width: 350px;
     height: 300px;
     background-color: #fff;
     box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
     padding: 20px;
     border-radius: 8px; 
     transition: background-color 0.3s ease;
     margin:100px auto;
 } 
 .sifreunuttum h2{
    color: #007bff;
    text-align: center; 

 } 

 .sifreunuttum input {
     width: 90%;
     padding: 10px;
     border: 1px solid #ddd;
     border-radius: 4px;
 } 
 .btnkayit {
     padding: 10px 15px;
     border: none;
     border-radius: 4px;
     color: #007bff;
     cursor: pointer;
     width: 96%;
     height: 40px;
     transition: background-color 0.3s ease;
     border: 1px solid #007bff;
     background-color: transparent;
 }

 .btnkayit:hover {
     background-color: #007bff;
     color: white;
 }

</style>'; 
            // Display password reset form
            echo '
            <div class="sifreunuttum">
            <h2 >Şifre Yenile</h2>
            <form id="sifreyenile" method="POST">
                <input id="yenile-password" type="password" placeholder="Yeni Şifre" name="Usifre" required>
                <br/><br/>
                <input id="yenile-password-tekrar" type="password" placeholder="Yeni Şifre Tekrar" name="Usifretekrar" required>
                <br/><br/>
                <button class="btnkayit" type="submit">Şifre Değiştir</button>
            </form>
                <div id="yenilehata" style="padding:5px;color:red;text-align:center "></div>  
            </div> 
            ';
        /* BURDAKİ JAVASCRİPT DOSYASINI LOGİN DOSYASINDAN ÇEKİYOR İNPUT KONTROLU YAPIYOR */
        echo '<script src="yenilesifrekontrol.js"></script>';
        }
    } else {
        showMessage('Geçersiz veya süresi dolmuş doğrulama kodu.');
        echo '<script>window.location.href = "./../index.php";</script>';
    }

    $stmt->close();
    $con->close();
}
?>
