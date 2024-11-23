<?php
////ZİYARET KONTROL DOSYASI
///BU DOSYAYI İNDEX.PHP DOSYASI ÇEKİYOR
/////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////SAYFAYA HER BİR KİŞİ GİRDİĞİNDE ZİYARET SQL TABLOSU 1 ARTAR///////////////// 
/////////////////////////////////////////////////////////////////////////////////////////////// 
include("./connect.php");

$today = date('Y-m-d');

// Günün ziyaretçi sayısını kontrol et
$sql = "SELECT visit_count FROM donerziyaretci WHERE visit_date = '$today'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Eğer veri varsa, güncelle
    $row = $result->fetch_assoc();
    $new_count = $row['visit_count'] + 1;
    $sql = "UPDATE donerziyaretci SET visit_count = $new_count WHERE visit_date = '$today'";
} else {
    // Eğer veri yoksa, yeni kayıt oluştur
    $new_count = 1;
    $sql = "INSERT INTO donerziyaretci (visit_date, visit_count) VALUES ('$today', $new_count)";
}

if ($con->query($sql) === TRUE) {
    // Başarıyla güncellendi
} else {
    echo "Hata: " . $sql . "<br>" . $con->error;
}

// Veritabanı bağlantısını kapat
$con->close();
?>