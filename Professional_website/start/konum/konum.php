
<?php 
////ZİYARET KONUM KONTROL DOSYASI
///BU DOSYAYI LOCATİON.PHP DOSYASI ÇEKİYOR
/////////////////////////////////////////////////////////////////////////////////////////////////////
////SAYFAYA HER BİR KİŞİ GİRDİĞİNDE EĞER KONUM BİLGİSİNİ PAYLAŞ DERSE ZİYARET SQL TABLOSU 1 ARTAR////
///////////////////////////////////////////////////////////////////////////////////////////////////// 
 
    
// Database connection
include("./../connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $ip = $_POST['ip'] ?? '';
    $latitude = $_POST['latitude'] ?? null;
    $longitude = $_POST['longitude'] ?? null;

    // Sanitize input
    $ip = $con->real_escape_string($ip);
    $latitude = $latitude !== null ? $con->real_escape_string($latitude) : 'NULL';
    $longitude = $longitude !== null ? $con->real_escape_string($longitude) : 'NULL';

    // Prepare and execute SQL query using prepared statements
    $stmt = $con->prepare("INSERT INTO donerlocation (konumlatitude, konumlongitude, konumcikisip) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $latitude, $longitude, $ip);

    if ($stmt->execute()) {
        echo "Data saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $con->close();
}
?>

