<!DOCTYPE html>
<html lang="tr">
<head> 
    <title>Döner</title>

 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

    <meta charset="”utf-8″">
    <meta name="theme-color" content="#ffffff" />
    <! SAYFA RENGİ >
    <meta name="keywords" content="taha keskin, islam, Allah, 5 taneden fazla girme" />
    <! ANAHTAR KELİME >
    <meta name="news_keywords" itemprop="keywords" content="5 taneden fazla girme" />
    <! ANAHTAR KELİME >
    <meta property="og:site_name" content="" />
    <! SİTE ADI >
    <meta name="twitter:site" content="@" />
    <! SİTE ADI >
    <meta name="generator" content="Optimist Hub" />
    <! SİTE ADI >
    <meta property="og:url" content="" />
    <! SİTE LİNKİ >
    <meta property="al:web:url" content="" />
    <! SİTE LİNKİ >
    <meta name="twitter:url" content="" />
    <! SİTE LİNKİ >
    <meta property="article:section_url" content="" />
    <! SİTE LİNKİ >
    <meta name="identifier-URL" content="" />
    <! SİTE LİNKİ >
    <meta property="article:publisher" content="" />
    <! SİTE LİNLİ >
    <meta property="og:title" content="" />
    <! SİTE AÇIKLAMA >
    <meta name="twitter:title" content="" />
    <! SİTE AÇIKLAMA >
    <meta property="og:description" content="" />
    <! SİTE AÇIKLAMA >
    <meta name="description" content="" />
    <! SİTE AÇIKLAMA >
    <meta name="twitter:description" content="" />
    <! SİTE AÇIKLAMA >
    <meta name="author" content="taha keskin" />
    <! KİM YAPTI >
    <meta property="article:author" content="taha keskin" />
    <! KİM YAPTI >
    <meta name="twitter:creator" content="@taha_keskin" />
    <! KİM YAPTI >
    <meta name="copyright" content="taha keskin" />
    <! TELİF HAKKI >
    <meta name="Abstract" content="" />
    <! SİTE ÖZETİ >
    <meta http-equiv="content-language" content="tr" />
    <! SİTE DİLİ >
    <meta property="og:locale" content="tr_TR" />
    <! KONUM >
    <meta property="og:type" content="article" />
    <! TÜRÜ >
    <meta property="og:type" content="website" />
    <! TÜRÜ >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <! SİTE MOBİL VE PC BOYUTU ORANLAR >
    <meta property="og:video:tag" content="" />
    <! VİDEO ADI >
    <meta name="og:image" content="" />
    <! SİTE RESMİ >
    <meta name="rating" content="general" />
    <! KİTLE >
 
    <link rel="shortcut icon" href="favicon32.ico" sizes="32x32" />
    <link rel="shortcut icon" href="favicon16.ico" sizes="32x32" />

 

    <!-- LOGİN KLASÖRÜNDEN ÇEKİYOR -->
    <link rel="stylesheet" href="./login/giris/lgnpage.css">
    <!-- LOGİN KLASÖRÜNDEN ÇEKİYOR -->
    <link rel="stylesheet" href="./login/giris/rememberme.css"> 


    <!-- İNDEX.CSS -->
    <link rel="stylesheet" href="index/index.css">
    <!-- İNDEX.JS -->
    <script src="index/index.js"></script> 


 

    <noscript>
        <meta http-equiv="refresh" content="0 ; url=https://www.youtube.com/channel/UCbJFy2KTBclbYfcaQFKZapQ">
    </noscript>


  

</head>
<body id="body" >   







<?php
///BAŞKA SAYFALARDAN ÇEKİNCE PHP MAİLER SAYFAYI TAMAMEN BOZUYO VE ÇALIŞMAZ HALE GETİRİYOR BUNDAN DOLAYI BAŞKA SAYFADAN ÇEKEMİYORUZ

////////////////ÜYE GİRİŞ KISMINI YÖNETİR
/////////////KULLANICI GİRİŞ YAPTIĞINDA SQL KISMINDAKİ TOKEN ADINDAKİ YERE COOKİE İÇİN OLUŞTURULAN TOKEN'I KAYDEDER
////////////////////////////////EĞER HESAP EPOSTA ONAYLAMADIYSA UYARI VERİR VE TEKRAR ONAY İÇİN CAPTCHA GÖNDERİR 
////////GİRİŞ YAPAN KULLANICININ İP ADRESİNİDE SQL TABLOSUNA KAYDEDER
////////GİRİŞ BAŞARILIYSA GİRİŞ BUTONU DİSPLAY NONE OLUP ÇIKIŞ BUTONU OLUŞTURULUR  
///////////////////////////////////////////////////SQLDEKİ TOKEN COOKİE'NİN TOKENI
///////////////////////////////////////////////////SQLDEKİ CAPTCHA İSE PHP VERİFİCATİON TOKENI
///////////////////////////////////////////////////BİRBİRİNE KARIŞTIRMA 
 
///////////////////////////////////////////////////KULLANICI GİRİŞ YAPTIĞINDA SESSİON VE COOKİE İÇİN TOKEN OLUŞTUR
/////////////////////////////////////EĞER HESAP EPOSTA ONAYLAMADIYSA UYARI VERİR VE TEKRAR ONAY İÇİN CAPTCHA GÖNDERİR  


session_start();  
include("connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php'; 

date_default_timezone_set('Europe/Istanbul');

$giris_basarili = false;   

if(isset($_POST["giris"])) {

    $email = $_POST['Gemail'];
    $sifre = $_POST['Gsifre'];

    // E-posta doğrulama
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script> document.getElementById("kayithata").innerHTML="Geçersiz email formatı"; </script>';
        exit();
    }

    $salt      = '@donerteka_';
    $hashed    = hash('sha256', $sifre . $salt);

    $email = stripcslashes($email);
    $hashed = stripcslashes($hashed);

    // Prepared statement kullanımı
    $stmt = $con->prepare("SELECT * FROM doner WHERE eposta = ? AND sifre = ?");
    $stmt->bind_param('ss', $email, $hashed);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {

        $sqlflip = "SELECT * FROM doner WHERE eposta = ? AND verification = 1";
        $stmt = $con->prepare($sqlflip);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $sonucflip = $stmt->get_result();

        if (mysqli_num_rows($sonucflip) > 0) {
            // Eğer Verification 1 ise giriş yap 

            $giris_basarili = true;
            $_SESSION['Gemail'] = $email;

            $token = bin2hex(random_bytes(32)); 
            $teka = '@donerteka_';
            $hashed_token = password_hash($token.$teka, PASSWORD_DEFAULT);  

 

            // IP adresini al
            function getUserIpAddr() {
                // Önce IP adresini almak için sırasıyla HTTP başlıkları kontrol edilir.
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    // Birden fazla IP adresi olabilir, en güvenilir olanı alın.
                    $ipArray = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                    $ip = trim($ipArray[0]);
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                // IP adresinin geçerli bir IPv4 adresi olup olmadığını kontrol et
                return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? $ip : '0.0.0.0';
            }   // Eğer IP adresi geçerli değilse, boş döndür

            $ip = getUserIpAddr();


            $stmt = $con->prepare("UPDATE doner SET token = ?, ipaddress = ? WHERE eposta = ?");
            $stmt->bind_param('sss', $hashed_token, $ip, $email);
            $stmt->execute(); 

            if(isset($_POST['beni_hatirla']) && $_POST['beni_hatirla'] == 'evet') {
                setcookie('token', $hashed_token, time() + (86400 * 30), "/");
                setcookie('Gemail', $email, time() + (86400 * 30), "/");  
                setcookie('beni_hatirla', 'evet', time() + (86400 * 30), "/"); 

                //COOKİE KONTROL.PHP DOSYASINA YÖNLENDİRİR
                //header("Location: cookiekontrol.php");
                //exit();  

                //echo '<script>window.location.href = "cookiekontrol.php";</script>';
            }
 
              //echo '<div style="color:red;position:fixed;left:87%;top:2%; z-index:3;padding: 5px 10px;border-radius: 4px;color: #ffffff;cursor: pointer;width: 70px;height: 25px;transition: background-color 0.3s ease;background-color: red;">'; 
              //echo '<a style="color:white;text-decoration:none;text-align:center;" href="logout.php"><div>Çıkış</div></a>';
              //echo '</div>';
              //echo '<style>.girisyapildi{display:none}</style>';  
 
              $_SESSION['Gemail'] = "$email";
              $_SESSION['token'] = "$hashed_token";

              //echo ' <header style="color:cyan">';
              //echo ' <div class="headercontainer fade-header">';
              //echo ' <nav style="display:flex">';
              //echo ' <div style="margin:0 200px 0 0 "><a href="#top"><h1>Soslu Döner</h1></a></div>';
              //echo ' <ul>'; 
              //echo '   <li><a href="#" onclick="news()">Yeni</a></li>';
              //echo '   <li><a href="#" onclick="hakkinda()">Hakkımızda</a></li> ';
              //echo '   <li><a href="#" onclick="tanitim()">Tanıtım</a></li>';
              //echo '   <li><a href="#" onclick="worker()">Ekibimiz</a></li>';
              //echo '   <li><a href="#" onclick="menu()">Menü</a></li>';
              //echo '   <li><a href="#" onclick="whatwedo()">Ne Yapıyoruz ?</a></li>';
              //echo '   <li><a href="#" onclick="gallery()">Galeri</a></li>';
              //echo '   <li><a href="#" onclick="iletisim()">İletişim</a></li>';
              //echo '   <li><a href="#" onclick="sss()">SSS</a></li> ';
              //echo '   <a href="logout.php"><li><button class="lgnheader-button" style="background:red">Çıkış</button></li></a>';
              //echo '   </ul>';
              //echo '   </nav>';
              //echo '   </div>';
              //echo '   </header> ';  
////////////////////////////////////////////////////////////////BURDAKİ DİV UL Lİ A KISIMLARINI DENE SESSİON COOKİE



        } else {
            // Eğer Verification 0 ise E-posta doğrulama kodu gönder

            $mail = new PHPMailer(true);
            try {
                // Sunucu ayarları
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = '_crazy_boy_taha_31@gmail.com';
                $mail->Password   = 'aqqqqasdqwdadalsdkşalskdşlasdlqıjwınwdajsdnmwoqdakda';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                // Gönderen ve alıcı ayarları
                $mail->setFrom('Doner@info.com', 'Doner');
                $mail->addAddress($email);

                // E-posta içeriği
                $mail->isHTML(true);
                $mail->Subject = "Email Verification";

                $token = bin2hex(random_bytes(32));
                $teka = '@donerteka_';
                $hashed_token = password_hash($token.$teka, PASSWORD_DEFAULT);

                // Geçerlilik süresi (5 dakika)
                $expiry = new DateTime();
                $expiry->add(new DateInterval('PT5M'));
                $expiry = $expiry->format('Y-m-d H:i:s');

                $verifyLink = "http://localhost/start/login/verify.php?token=" . urlencode($hashed_token);

                $mail->Body = "<p>Your verification link is: <a style='font:bold 30px arial;color:red;text-decoration:none' href='".$verifyLink."'>Verify</a></p>";

                $mail->send();

                // Token ve geçerlilik süresini veri tabanına ekle
                $stmt = $con->prepare("UPDATE doner SET captcha = ?, captchaexpiry = ? WHERE eposta = ?");
                $stmt->bind_param("sss", $hashed_token, $expiry, $email);

                if (!$stmt->execute()) {
                    die("Veri eklenirken bir hata oluştu: " . $stmt->error);
                }

                echo "<h3 style='color:red;text-align:center'>Efenim Lütfen E-posta Doğrulayın. E-posta başarıyla gönderildi.</h3>";
            } catch (Exception $e) {
                echo "Mesaj gönderilemedi. Mailer Hatası: {$mail->ErrorInfo}";
            }
        }
    }


    
    else {   
        echo "<h3 style='color:red;text-align:center'>Efenim Kullanıcı Adı veya Şifre Yanlış</h3>";  
    }

    $stmt->close();
    mysqli_close($con);
} 
?> 

<?php
////////////////LOGİN DOSYASINDAKİ SESSİON.PHP DOSYASI 
////GELEN SESSİONDAKİ EPOSTA VE TOKEN DOĞRUYSA ÇIKIŞ BUTONU OLUŞTUR



//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////BU KISIM GEÇİCİDİR EĞER SORUNSUZ ÇALIŞIYORSA KALSIN //////////////////////////
////////////////////////DÜZGÜN ÇALIŞIYORSA COOKİEKONTROL.PHP DOSYASINI SİLMEYİ UNUTMA/////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////SESSİON VE COOKİE TOKEN'I SQLDEKİYLE DENKSE
///////////////////////////////////////////////////İNDEX.PHP YÖNLENDİR 
///////////////////////////////////////////////////DEĞİLSE LOGOUT.PHP YÖNLENDİR

 
include("connect.php");

if (isset($_COOKIE['beni_hatirla']) && $_COOKIE['beni_hatirla'] == 'evet' && isset($_COOKIE['Gemail']) && isset($_COOKIE['token'])) {
    
    $_SESSION['Gemail'] = $_COOKIE['Gemail'];
    $_SESSION['token'] = $_COOKIE['token'];

    $email = $_COOKIE['Gemail'];
    $token = $_COOKIE['token'];

 
    $stmt = $con->prepare("SELECT * FROM doner WHERE eposta = ? AND token = ?");
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) { 
        //header("Location: index.php"); 
        //exit;  
    } else { 
        header("Location: ./login/logout.php"); 
        exit;  
    }

    $stmt->close();

}

else{
    //header("Location: index.php"); 
    //exit; 
} 

mysqli_close($con); 
 
 

?>

<?php
////////////////LOGİN DOSYASINDAKİ SESSİON.PHP DOSYASI 
////GELEN SESSİONDAKİ EPOSTA VE TOKEN DOĞRUYSA ÇIKIŞ BUTONU OLUŞTUR
include("./sessionkontrol.php");  
?>

<?php
////////////////LOGİN DOSYASINDAKİ ZİYARET.PHP DOSYASI 
////EĞER SAYFAYA BİRİ GİRERSE SQL KISMINDA 1 ARTTIR DİYORUZ YANİ GÜNLÜK KAÇ KİŞİ GİRMİŞ BUNLARI TUTUYO
include("./ziyaret.php");
?>
 


















  <!-- ARROW KLASÖRÜNDEN ÇEKİYOR -->
    <link rel="stylesheet" href="./arrow/btnup.css">

    <a href="#top" class="scroll-to-top" id="scrollToTopBtn">&#11165;</a> 
  <!-- ARROW KLASÖRÜNDEN ÇEKİYOR -->
    <script src="./arrow/btnup.js"></script> 

 
  
    <div class="lgnoverlay" id="lgnoverlay"></div>
    <div class="lgnpanel" id="lgnpanel"  style="height:450px ">
        <button class="close-panel" id="close-panel-button">&times;</button>
        <div class="form-container" id="signup-container">
            <h2>Kayıt Ol</h2>

            <form id="kayit-form" method="POST"> 
                <input type="email" id="kayit-mail" required placeholder="Mail" name="Kemail"> 
                <br/><br/>
                <input type="password" id="kayit-password" required placeholder="Şifre" name="Ksifre">
                <br/><br/>

                <div id="kayithata" style="padding:5px;color:red;text-align:center "></div>

                <br/>
                <!-- GİZLİ İNPUT EKLENDİ        /////////////////////////////////////////////// -->
                <input type="text" name="gizli_kayit" value="Teka1453"> 

                <button type="submit" class="btnkayit" name="uyeol">Kayıt Ol</button>
                
            </form>
        </div>   

        <!-- LOGİN KLASÖRÜNDEN ÇEKİYOR İÇERİSİNDE BOT KONTROLDE VAR -->
        <script src="./login/kayit/kayitsifrekontrol.js"></script>  
 
 

        


<?php
///BAŞKA SAYFALARDAN ÇEKİNCE PHP MAİLER SAYFAYI TAMAMEN BOZUYO VE ÇALIŞMAZ HALE GETİRİYOR BUNDAN DOLAYI BAŞKA SAYFADAN ÇEKEMİYORUZ

///UYE KAYIT
///EĞER KULLANICI VARSA ÜYE KAYIT ETME AMA EĞER KULLANICI YOKSA KAYIT ET VE EPOSTAYA DOĞRULAMA KODU GÖNDER
////////////////////////////UYE KAYIT ETTİKTEN SONRA 5 DAKİKALIK SÜRESİ OLAN VERİFİCATİON KODU GÖNDERİYOR
////////////////////////////YUKARDA PHPMAİLER ÇAĞIRDIĞIMIZ İÇİN BURDA ÇAĞIRAMIYORUZ
 //use PHPMailer\PHPMailer\PHPMailer;
 //use PHPMailer\PHPMailer\Exception;
 //require 'phpmailer/src/Exception.php';
 //require 'phpmailer/src/PHPMailer.php';
 //require 'phpmailer/src/SMTP.php'; 

 include("connect.php");

 // Türkiye saat dilimini ayarla
 date_default_timezone_set('Europe/Istanbul');
 
 if (isset($_POST["uyeol"])) {
 
     $email = filter_var(trim($_POST['Kemail']), FILTER_SANITIZE_EMAIL);
     $password = trim($_POST['Ksifre']); 
 
     // E-posta doğrulama
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         echo '<script> document.getElementById("kayithata").innerHTML="Geçersiz email formatı"; </script>';
         exit();
     }
 
     // Şifre hashleme
     $salt = '@donerteka_';
     $hashedPassword = hash('sha256', $password . $salt);
 
     // Kullanıcıyı kontrol et
     $stmt = $con->prepare("SELECT * FROM doner WHERE eposta = ?");
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         echo '<script> document.getElementById("kayithata").innerHTML="Kullanıcı Mevcut"; </script>';
     } else {
         // Kullanıcıyı ekle
         $stmt = $con->prepare("INSERT INTO doner (eposta, sifre) VALUES (?, ?)");
         $stmt->bind_param("ss", $email, $hashedPassword);
 
         if ($stmt->execute()) {
             echo '<script> document.getElementById("kayithata").innerHTML="Aramıza Hoşgeldin"; </script>';
 
             // E-posta doğrulama işlemi
             $mail = new PHPMailer(true);
             try {
                 // Sunucu ayarları
                 $mail->isSMTP();
                 $mail->Host       = 'smtp.gmail.com';
                 $mail->SMTPAuth   = true;
                 $mail->Username   = '_crazy_boy_taha_31@gmail.com';
                 $mail->Password   = 'asdasdasdqweasdasdzxcqwesdasda';
                 $mail->SMTPSecure = 'tls';
                 $mail->Port       = 587;
 
                 // Gönderen ve alıcı ayarları
                 $mail->setFrom('Doner@info.com', 'Doner');
                 $mail->addAddress($email,$email);
 
                 // E-posta içeriği
                 $mail->isHTML(true);
                 $mail->Subject = "Email Verification";
 
                 $token = bin2hex(random_bytes(32));
                 $teka = '@donerteka_';
                 $hashed_token = password_hash($token.$teka, PASSWORD_DEFAULT);
 
                 // Geçerlilik süresi (5 dakika)
                 $expiry = new DateTime();
                 $expiry->add(new DateInterval('PT5M'));
                 $expiry = $expiry->format('Y-m-d H:i:s');
 
                 $verifyLink = "http://localhost/start/login/verify.php?token=" . urlencode($hashed_token);
 
                 $mail->Body = "<p>Your verification link is: <a style='font:bold 20px arial;color:red;text-decoration:none' href='".$verifyLink."'>Verify</a></p>";
 
                 $mail->send();
  
                 // Token ve geçerlilik süresini veri tabanına ekle
                 $stmt = $con->prepare("UPDATE doner SET captcha = ?, captchaexpiry = ? WHERE eposta = ?");
                 $stmt->bind_param("sss", $hashed_token, $expiry, $email);
 
                 if (!$stmt->execute()) {
                     die("Veri eklenirken bir hata oluştu: " . $stmt->error);
                 }
 
                 echo "<div style='color:red'>Doğrulama Kodu E-posta'na başarıyla gönderildi.</div>";
                
         
 
             } catch (Exception $e) {
                 echo "Mesaj gönderilemedi. Mailer Hatası: {$mail->ErrorInfo}";
             }
         } else {
             echo "<script> document.getElementById('kayithata').innerHTML='Üye eklenirken hata oluştu: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8') . "'; </script>";
         }
 
         $stmt->close();
     }
 
     $con->close();
 } 


?>
 



            <div class="form-container" id="login-container" style="display: none;">
            <h2>Giriş Yap</h2>
            <form method="POST" id="giris-form"> 
                <input type="email" id="giris-email" required placeholder="Mail" name="Gemail">
                <br/><br/>
                <input type="password" id="giris-password" required placeholder="Şifre" name="Gsifre">
                <br/><br/>
                

                <div style="text-align:center">Beni Hatırla</div>
                <div class="cbxhatirla">
                  <input id="cbx" type="checkbox" name="beni_hatirla" value="evet">
                  <label for="cbx"></label>
                  <svg width="16" height="13" viewBox="0 0 16 13" fill="none">
                    <path d="M1 8.36364L6.23077 12L13 4"/>
                  </svg>
                </div>   

                <br/>
                <!-- GİZLİ İNPUT EKLENDİ        /////////////////////////////////////////////// -->
                <input type="text" name="gizli_giris" value="Teka1453">


                <button type="submit"  class="btnlogin" name="giris">Giriş Yap</button> 
                <br/><br/>

                <button class="btntoggle" style="border:none" onclick="sifreunuttum ()" type="button">Şifre Unuttum</button>

            </form>
        </div>

        


        <div class="message" id="message"></div>

        <button class="btntoggle" id="toggle-form-button">Giriş Yap</button>
    </div>
  

  <!-- LOGİN GİRİŞ KLASÖRÜNDEN ÇEKİYOR İÇERİSİNDE BOT KONTROLDE VAR-->
  <script src="./login/giris/girissifrekontrol.js"></script>  


   
 
<!-- LOGİN UNUTTUM KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./login/unuttum/sifreunuttum.css">


<div class="sifreunuttum" id="dvsifreunuttum" style="display:none"> 
        <h2 >Şifre Unuttum</h2>
        <form method="POST" id="unuttum-form">
        <input type="email" placeholder="Email Giriniz" name="Ueposta" required>
        <br/><br/>

        <!-- GİZLİ İNPUT EKLENDİ        /////////////////////////////////////////////// -->
        <input type="text" name="gizli_unuttum" value="Teka1453">

        <button class="btnkayit" type="submit" name="btnkodgönder">Kod Gönder</button>
        </form>  
        <button class="btnkayit" id="unuttumgeri">Geri</button>
        <br/> 
        <div id="Usifrehata"></div>
    </div>


    <!-- LOGİN KLASÖRÜNDEN ÇEKİYOR -->
    <script src="./login/unuttum/sifreunuttum.js"></script>

    <!-- LOGİN KLASÖRÜNDEN ÇEKİYOR -->
    <script src="./login/giris/lgntoggle.js"></script>  


<?php
///BAŞKA SAYFALARDAN ÇEKİNCE PHP MAİLER SAYFAYI TAMAMEN BOZUYO VE ÇALIŞMAZ HALE GETİRİYOR BUNDAN DOLAYI BAŞKA SAYFADAN ÇEKEMİYORUZ
 
//ŞİFRE UNUTTUM 
////////////////////////////UYE ŞİFRE UNUTTUM KULLANICI EPOSTASINI GİRİP KOD GÖNDER DEDİKTEN SONRA EĞER EPOSTA SUNUCUDA
////////////////////////////KAYITLIYSA VERİFİCATİON GÖNDERİYOR VE SQL KISMINDA VERİFİCATİON 0 A GETİRİYOR 
////////////////////////////MANTIK ŞU EĞER VERİFİCATİON 0 DAN 1 OLMAZSA ÜYE GİRİŞİ VE ŞİFRE DEĞİŞTİRME İŞLEMİ YAPAMIYOR
////////////////////////////YUKARDA PHPMAİLER ÇAĞIRDIĞIMIZ İÇİN BURDA ÇAĞIRAMIYORUZ
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//require 'phpmailer/src/Exception.php';
//require 'phpmailer/src/PHPMailer.php';
//require 'phpmailer/src/SMTP.php'; 

include("connect.php"); 

date_default_timezone_set('Europe/Istanbul');

// Şifre sıfırlama kodu gönderme işlemi
if (isset($_POST["btnkodgönder"])) {
    $email = filter_var(trim($_POST['Ueposta']), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script> document.getElementById("Usifrehata").innerHTML="Geçersiz email formatı"; </script>';
        exit();
    }
 
    // Kullanıcıyı varmı
    $stmt = $con->prepare("SELECT * FROM doner WHERE eposta = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //kullanıcı varsa
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '_crazy_boy_taha_31@gmail.com';
            $mail->Password   = 'qqweqwehghfghfhtrcvxa';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('Doner@info.com', 'Doner');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Password Reset";

            $token = bin2hex(random_bytes(32));
            $teka = '@donerteka_';
            $hashed_token = password_hash($token.$teka, PASSWORD_DEFAULT);

            $expiry = new DateTime();
            $expiry->add(new DateInterval('PT5M'));
            $expiry = $expiry->format('Y-m-d H:i:s');

            $verifyLink = "http://localhost/start/login/sifreyenile.php?token=" . urlencode($hashed_token) . "&email=" . urlencode($email);

            $mail->Body = "<p>Şifreyi yenilemek için tıklayın: <a style='font:bold 20px arial;color:red;text-decoration:none' href='" . $verifyLink . "'>Yenile</a></p>";

            $mail->send();


            $verificationchange = 0;
            // Token ve geçerlilik süresini veri tabanına ekle  
            //SQL KISMINDAKİ SORGUDA verification 0 A DÖNÜŞTÜRMEK YERİNE verification = NULL İFADESİNİDE KULLANABİLİRSİN
            $stmt = $con->prepare("UPDATE doner SET captcha = ?, captchaexpiry = ?, verification = ? WHERE eposta = ?");
            $stmt->bind_param("ssss", $hashed_token, $expiry,$verificationchange, $email);


            
         

            

            if (!$stmt->execute()) {
                die("Veri güncellenirken bir hata oluştu: " . $stmt->error);
            }

            echo "<div style='color:red'>Doğrulama kodu e-posta adresinize başarıyla gönderildi.</div>";
        } catch (Exception $e) {
            echo "Mesaj gönderilemedi. Mailer Hatası: {$mail->ErrorInfo}";
        }

        $stmt->close();
    } else {
        //kullanıcı yoksa
        echo '<script> document.getElementById("Usifrehata").innerHTML="Kullanıcı mevcut değil"; </script>';
    }

    $con->close();
}
?>

 

  <!-- HEADER KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="header/header.css">
 
 
<!-- 
<header >
    <div class="headercontainer fade-header">
        <nav style="display:flex">
            <div style="margin:0 200px 0 0 "><a href="#top"><h1>Soslu Döner</h1></a></div>
            <ul>
                <li><a href="#" onclick="news()">Yeni</a></li>
                <li><a href="#" onclick="hakkinda()">Hakkımızda</a></li> 
                <li><a href="#" onclick="tanitim()">Tanıtım</a></li>
                <li><a href="#" onclick="worker()">Ekibimiz</a></li>
                <li><a href="#" onclick="menu()">Menü</a></li>
                <li><a href="#" onclick="whatwedo()">Ne Yapıyoruz ?</a></li>
                <li><a href="#" onclick="gallery()">Galeri</a></li>
                <li><a href="#" onclick="iletisim()">İletişim</a></li>
                <li><a href="#" onclick="sss()">SSS</a></li> 
                <li><button class="lgnheader-button girisyapildi" id="toggle-panel-button">Giriş</button></li>
            </ul>
        </nav>
    </div>
</header> 
-->


<section id="home" class="line1hero fade-p1">
    <div class="line1hero-content fade-p1">
        <h2>Modern Hatay Usulü Dönercim</h2>
        <p>Yeni hatay usulu dönere bayılacaksınız...!!</p>
        <br/>
        <a href="#events" class="btn" onclick="line1tanitim()">Daha Fazla</a>
    </div>
</section>

<br/> 
<br/><br/><br/><br/><br/>   


  <!-- YENİ KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./yeni/yeni.css"> 

<div style="display: flex">
    <div class="line2yazishadow "></div>
    <div class="line2yazi fade-p2">
        <h1>DÖNERİMİZDEN DENEYİN</h1>
        <br/><br/><br/>
        <br/><br/><br/>
        <button onclick="line2tanitim()" onmouseover="online2btn()" onmouseout="outline2btn()" class="line2yazia">
            <h3 id="line2btn">BİZE KATIL</h3>
        </button>
    </div>
 
    <div class="line2doner fade-p2"></div> 

    <div class="line2donershadow "></div>
</div>

  <!-- YENİ KLASÖRÜNDEN ÇEKİYOR -->
<script src="./yeni/yeni.js"></script> 


<br/> 

  <!-- HAKKIMIZDA KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./hakkimizda/hakkimizda.css">

<div class="txtline3 fade-p3">
    <h1>Dönercim</h1>
    <h3>Bizim için önemli olan kalite, güven ve sadakat</h3>
    <h3>Eğer kalite olmazsa güven olmaz.</h3>
    <h3>Eğer güven olmazsa sadakat olmaz.</h3>
    <h3>Eğer sadakat olmazsa biz olmayız.</h3>
    <br/>
    <button class="btnline3" onclick="line3galeri()">
         Galeri 
    </button>
</div>

<br/><br/><br/><br/> 
<br/><br/><br/><br/><br/><br/><br/><br/><br/>

  <!-- TANİTİM KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./tanitim/tanitim.css">

<div style="display:flex" class="fade-p4">
    <div class="divline4shadow"></div>
    <div class="divline4left">
        <h1>Geçtiğimiz Yılın Verileri</h1>
        <h3>3 yıl önce açtığımız dönerci binlerce insanı çocuğu genci yaşlıyı mutlu etti ve şimdi Almanya, Fransa ve İngilterede</h3>
        <span class="spanline4ust">30+
        <br/>
        <span class="spanline4alt">Yıl</span>
        </span>
        <span class="spanline4ust">25+
        <br/>
        <span class="spanline4alt">Şube</span>
        </span>
        <span class="spanline4ust">10+
        <br/>
        <span class="spanline4alt">Şehir</span>
        </span>
    </div> 

    <div class="divline4right">
        <a id="openModal">
            <div class="divline4rightimage" id="videoThumbnail">
                <div class="play-icon" id="play-icon"></div>
            </div>
        </a>    
    </div>
</div> 
 
 

 <div id="videoModal" class="modal ">
 <div class="modal-content">
 <span class="close">&times;</span> 
 <iframe  id="videoFrame" width="900" height="500" src="" frameborder="0" allowfullscreen></iframe>
 </div>
 </div>  

  <!-- TANİTİM KLASÖRÜNDEN ÇEKİYOR -->
 <script src="./tanitim/tanitim.js"></script> 


 <!-- EKİBİMİZ KLASÖRÜNDEN ÇEKİYOR -->
 <link rel="stylesheet" href="ekibimiz/ekibimiz.css"> 
 
 <div class="fade-p5">
    <div class="txtline5" >
    Dönerci Çalışanları
    </div>

    <div class="divline5 ">


    <div class="divline5img1" id="line5img1" onmouseover="ondivline5img1()" onmouseout="outdivline5img1()">
        
    <span class="divline5txt">Ahmet Rıza</span> 

    </div> 

    <div class="divline5img2" id="line5img2" onmouseover="ondivline5img2()" onmouseout="outdivline5img2()">

    <span class="divline5txt">Cristiona Eqe</span>
        
    </div>

    <div  class="divline5img3" id="line5img3" onmouseover="ondivline5img3()" onmouseout="outdivline5img3()">
        
    <span class="divline5txt">Cinero Geppe</span>

    </div>

    <div  class="divline5img4" id="line5img4" onmouseover="ondivline5img4()" onmouseout="outdivline5img4()">
        
    <span class="divline5txt">Jack Sparrow</span>

    </div>  
</div> 
</div> 

 <!-- EKİBİMİZ KLASÖRÜNDEN ÇEKİYOR -->
<script src="ekibimiz/ekibimiz.js"></script> 

<br/><br/><br/><br/> 
<br/><br/><br/><br/><br/> 

 <!-- MENU KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./menu/menu.css">
 
<div class="slider fade-p6" onmouseover="pauseSlide()" onmouseout="resumeSlide()">
    <div class="slide" id="slide1"></div>
    <div class="slide" id="slide2"></div>
    <div class="slide" id="slide3"></div>
    <div class="slide" id="slide4"></div>
    <button class="prev" onclick="prevSlide()">&#10094;</button>
    <button class="next" onclick="nextSlide()">&#10095;</button>
    <div class="dot-container">
        <span class="dot" onclick="currentSlide(0)"></span>
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
    </div>
</div>  

 <!-- MENU KLASÖRÜNDEN ÇEKİYOR -->
<script src="./menu/slide.js"></script> 



 <!-- NE YAPIYORUZ KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./neyapiyoruz/whatwedo.css">

<div class="divline7shadow"></div>  


<div class="fade-p7">
<div class="divline7txtust">
    <h1>Biz Neler Yapıyoruz</h1>
</div>

<div class="divline7txtalt ">
    <div id="services">
        <div class="service">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="number">1 </div> 
                        <div class="text">
                            <h2>Doğum Günü Partileri</h2>
                            <p>Konsept ve tasarımdan etkinliğin üretimine ve yönetimine kadar kurumsal etkinliklerde yaratıcılık.</p>
                        </div>
                    </div>
                    <div class="flip-card-back"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="number">2</div>
                        <div class="text">
                            <h2>Ticari Servis</h2>
                            <p>Ticari işletmelere servisimiz mevcuttur kapasitemiz 200 döner'i geçmektedir.</p>
                        </div>
                    </div>
                    <div class="flip-card-back"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="number">3</div>
                        <div class="text">
                            <h2>Cenaze Yemekleri</h2>
                            <p>Cenaze için herhangibi istenilen yemek türü yapabiliriz.</p>
                        </div>
                    </div>
                    <div class="flip-card-back"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="number">4</div>
                        <div class="text">
                            <h2>Paket Servis</h2>
                            <p>7/24 istediğiniz zaman ve istediğiniz yerde sadece bizi arayın.</p>
                        </div>
                    </div>
                    <div class="flip-card-back"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="number">5</div>
                        <div class="text">
                            <h2>Nişan Düğün</h2>
                            <p>Nişan ve düğünlere özel yemeklerimiz mevcuttur ve yeni evlenen çiftlerimize indirimlerimizi kaçırma.</p>
                        </div>
                    </div>
                    <div class="flip-card-back"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="service">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="number">6</div>
                        <div class="text">
                            <h2>Sünnet</h2>
                            <p>Sünnet yemeklerinde tavuk pilavınızı bizden alın.</p>
                        </div>
                    </div>
                    <div class="flip-card-back"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
                </div>

 

<br/><br/><br/><br/><br/><br/><br/><br/><br/> 
<br/><br/><br/><br/>


<!-- GALERİ KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./galeri/galeri.css">


<div class="fade-p8">
<div class="divline8txtust ">
<h1>GALERİ</h1>
</div> 

<br/> 
<div class="divline8txtalt" >
    <div id="line8galeri">

        <div class="line8galeri" onmouseover="online8img1()" onmouseout="outline8img1()"></div>
        <div class="line8galeri" onmouseover="online8img2()" onmouseout="outline8img2()"></div>
        <div class="line8galeri" onmouseover="online8img3()" onmouseout="outline8img3()"></div>
        <div class="line8galeri" onmouseover="online8img4()" onmouseout="outline8img4()"></div>
        <div class="line8galeri" onmouseover="online8img5()" onmouseout="outline8img5()"></div>
        <div class="line8galeri" onmouseover="online8img6()" onmouseout="outline8img6()"></div>

    </div>
 

</div>
</div> 

<div class="divline8shadow" id="line8shadow"></div> 

<!-- GALERİ KLASÖRÜNDEN ÇEKİYOR -->
<script src="./galeri/galeri.js"></script> 
 

 
 
<br/><br/> 

<!-- İLETİŞİM KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./iletisim/contact.css">

<section id="line9contact" class="fade-p9">
    <div class="line9container"> 
        <h2>İletişim</h2></div>
        <form id="contact-form" method="POST">
            <label for="name">Ad :</label>
            <input type="text" required name="contactname" id="iletisimad">
            <label for="email">Email :</label>
            <input type="email" required name="contactemail" id="iletisimemail">
            <label for="message">Mesaj :</label>
            <textarea required name="contactmesaj" id="iletisimmesaj"></textarea> 
            <br/><br/>
        <!-- GİZLİ İNPUT EKLENDİ        /////////////////////////////////////////////// -->
        <input type="text" name="gizli_contact" value="Teka1453">

            <button type="submit" name="contactgonder">Gönder</button>
            <br/><br/>
            <div id="contacthata"></div>
        </form>
</section>

<script src="./iletisim/iletisimformkontrol.js"></script> 

<?php  
///////////////////////////////////Doner İletişim Kısmı
///BU SAYFAYI İLETİŞİM KLASÖRÜNDEN ÇEKİYOR
//AD, EMAİL VE MESAJ OLARAK 3 KISIMDAN OLUŞUYOR EMAİL MESAJ GÖNDERMEKTENSE SQL KISMINA YAZIYOR VE ADMİN PANEL KISMINDA DA MESAJLARI GÖRÜYORUZ
include ("./iletisim.php");  
?>
 

<br/><br/> <br/><br/><br/><br/><br/><br/>

<!-- SSS KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./sss/sss.css">
 
<div class="line10sss fade-p10">
        <h1 >Sıkça Sorulan Sorular (SSS)</h1> 
        <section class="faq">  
            <div class="faq-item">
                <h2 class="faq-question">1. Siparişimde bir sorun yaşarsam ne yapmalıyım?</h2>
                <p class="faq-answer">Herhangi bir sorun yaşarsanız, lütfen bizimle [iletişim bilgileri] üzerinden iletişime geçin. Sorununuzu çözmek için size yardımcı olmaktan memnuniyet duyarız. Sipariş numaranızı ve yaşadığınız sorunu belirten ayrıntıları da paylaşmanız hızlı çözüm sürecini sağlar.</p>
            </div> 

            <div class="faq-item">
                <h2 class="faq-question">2. Müşteri destek ekibine nasıl ulaşabilirim?</h2>
                <p class="faq-answer">Müşteri destek ekibimize [iletişim bilgileri] üzerinden ulaşabilirsiniz. Size en iyi hizmeti sunabilmek için [telefon numarası, e-posta adresi, canlı sohbet seçeneği] gibi çeşitli iletişim kanalları sunuyoruz.</p>
            </div> 
            
            <div class="faq-item">
                <h2 class="faq-question">3. Yeni ürünler ve kampanyalardan nasıl haberdar olabilirim?</h2>
                <p class="faq-answer">Yeni ürünler ve kampanyalardan haberdar olmak için [bülten kayıt formu]na abone olabilir veya sosyal medya hesaplarımızı takip edebilirsiniz. Ayrıca, e-posta bültenimiz aracılığıyla düzenli olarak güncellemeler alabilirsiniz.</p>
            </div> 
        </section> 
</div> 
 

<!-- FOOTER KLASÖRÜNDEN ÇEKİYOR -->
<link rel="stylesheet" href="./footer/footer.css">
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Şirket Adı. Tüm hakları saklıdır.</p>
            <div class="social-media">
                <a href="https://facebook.com" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer> 
    


<script src="./index/scrollposition.js"></script> 

 


<?php include("./location.php") ?>   


 <!--
<script src="./konum/location.js"></script> 
 -->


 <script src="bottespit.js"></script>

 <?php 
///////////////////////////////////////////////BOT KONTROL
 
if (!isset($_SESSION['requests'])) {
    $_SESSION['requests'] = 0;
    
    echo "<script>";
echo "console.log('2')";
echo "</script>";

}
$_SESSION['requests']++;
if ($_SESSION['requests'] > 100) { // Örnek limit
    die('Hız limiti aşıldı.');

    echo "<script>";
echo "console.log('1')";
echo "</script>";
}

 ?>






</body>
</html>
