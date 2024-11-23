<?php
////SESSİON KONTROL DOSYASI
///////////////////////////////////////////////////SESSİON VE COOKİE TOKEN KONTROL
///////////////////////////////////////////////////EĞER TOKEN SQLDEKİ İLE DENK İSE DİV OLUŞTURUYO

if (isset($_SESSION['Gemail']) && isset($_SESSION['token'])) {
    include("./connect.php");

    $Semail = $_SESSION['Gemail'];
    $token = $_SESSION['token'];
      
    $stmt = $con->prepare("SELECT eposta, token FROM doner WHERE eposta = ? AND token = ?");
    $stmt->bind_param("ss", $Semail, $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc(); 
 
        //////EĞER BURDAKİ KONTROLDE YANLIŞ VARSA SADECE ÇIKIŞ BUTONU GÖSTER EĞER SORUN YOKSA ADMİN GİRİŞ BUTONUNUDA GÖSTER
        $stmt = $con->prepare("SELECT eposta, token FROM doner WHERE eposta = ? AND token = ? AND yetki = 1");
        $stmt->bind_param("ss", $Semail, $token);
        $stmt->execute();
        $sonucflip = $stmt->get_result();


        if ($sonucflip->num_rows > 0) { 
            echo ' <header style="color:cyan">';
            echo ' <div class="headercontainer fade-header">';
            echo ' <nav style="display:flex">';
            echo ' <div style="margin:0 200px 0 0 "><a href="#top"><h1>Soslu Döner</h1></a></div>';
            echo ' <ul>';  
            echo ' <li><a href="#">Hoşgeldin Admin</a></li> ';
            echo ' <li><a href="#" onclick="tanitim()">Tanıtım</a></li>';
            echo ' <li><a href="#" onclick="worker()">Ekibimiz</a></li>';
            echo ' <li><a href="#" onclick="menu()">Menü</a></li>';
            echo ' <li><a href="#" onclick="whatwedo()">Ne Yapıyoruz ?</a></li>';
            echo ' <li><a href="#" onclick="gallery()">Galeri</a></li>';
            echo ' <li><a href="#" onclick="iletisim()">İletişim</a></li>'; 
            echo ' <a href="./admin/adminpanel.php"><li><button class="lgnadmin-button">Admin</button></li></a>';
            echo ' <a href="./login/logout.php"><li><button class="lgncikis-button">Çıkış</button></li></a>';
            echo ' </ul>';
            echo ' </nav>';
            echo ' </div>';
            echo ' </header> '; 
        }



        else {
            echo ' <header style="color:cyan">';
            echo ' <div class="headercontainer fade-header">';
            echo ' <nav style="display:flex">';
            echo ' <div style="margin:0 200px 0 0 "><a href="#top"><h1>Soslu Döner</h1></a></div>';
            echo ' <ul>'; 
            echo '   <li><a href="#" onclick="news()">Yeni</a></li>';
            echo '   <li><a href="#" onclick="hakkinda()">Hakkımızda</a></li> ';
            echo '   <li><a href="#" onclick="tanitim()">Tanıtım</a></li>';
            echo '   <li><a href="#" onclick="worker()">Ekibimiz</a></li>';
            echo '   <li><a href="#" onclick="menu()">Menü</a></li>';
            echo '   <li><a href="#" onclick="whatwedo()">Ne Yapıyoruz ?</a></li>';
            echo '   <li><a href="#" onclick="gallery()">Galeri</a></li>';
            echo '   <li><a href="#" onclick="iletisim()">İletişim</a></li>';
            echo '   <li><a href="#" onclick="sss()">SSS</a></li> '; 
            echo '   <a href="./login/logout.php"><li><button class="lgncikis-button">Çıkış</button></li></a>';
            echo '   </ul>';
            echo '   </nav>';
            echo '   </div>';
            echo '   </header> '; 
        }












        /*
        echo '<div style="color:red;position:fixed;left:87%;top:2%; z-index:3;padding: 5px 10px;border-radius: 4px;color: #ffffff;cursor: pointer;width: 70px;height: 25px;transition: background-color 0.3s ease;background-color: red;">'; 
        echo '<a style="color:white;text-decoration:none;text-align:center;" href="logout.php"><div>Çıkış</div></a>';
        echo '</div>';
        echo '<style>.girisyapildi{display:none}</style>'; 
*/////////////////////////////////////////////////////////////////BURDAKİ DİV UL Lİ A KISIMLARINI DENE SESSİON COOKİE

    


    } else {
        echo "Kullanıcı veya token bulunamadı."; 
    }
 
    $stmt->close();
    $con->close(); 

} else { 
    /*
    echo '<div style="color:cyan;position:fixed;left:67%;top:2%; z-index:3;padding: 5px 10px;border-radius: 4px;color: #ffffff;cursor: pointer;width: 70px;height: 25px;transition: background-color 0.3s ease;background-color: red;">'; 
    echo '<a style="color:white;text-decoration:none;text-align:center;" href="logout.php"><div>MEMATİ BAŞ</div></a>';
    echo '</div>'; */
////////////////////////////////////////////////////////////////BURDAKİ DİV UL Lİ A KISIMLARINI DENE SESSİON COOKİE

  echo ' <header >';
  echo ' <div class="headercontainer fade-header" >';
  echo ' <nav style="display:flex">';
  echo ' <div style="margin:0 200px 0 0 "><a href="#top"><h1>Soslu Döner</h1></a></div>';
  echo ' <ul>'; 
  echo '   <li><a href="#" onclick="news()">Yeni</a></li>';
  echo '   <li><a href="#" onclick="hakkinda()">Hakkımızda</a></li> ';
  echo '   <li><a href="#" onclick="tanitim()">Tanıtım</a></li>';
  echo '   <li><a href="#" onclick="worker()">Ekibimiz</a></li>';
  echo '   <li><a href="#" onclick="menu()">Menü</a></li>';
  echo '   <li><a href="#" onclick="whatwedo()">Ne Yapıyoruz ?</a></li>';
  echo '   <li><a href="#" onclick="gallery()">Galeri</a></li>';
  echo '   <li><a href="#" onclick="iletisim()">İletişim</a></li>';
  echo '   <li><a href="#" onclick="sss()">SSS</a></li> '; 
  echo '   <li><button class="lgngiris-button girisyapildi" id="toggle-panel-button">Giriş</button></li>'; 
  echo '   </ul>';
  echo '   </nav>';
  echo '   </div>';
  echo '   </header> '; 


}

?>