<?php
include("../../connect.php");

// MySQLi bağlantısını kontrol et
if (!$con) {
    die(json_encode(['error' => 'Veritabanı bağlantısı sağlanamadı.']));
}

header('Content-Type: application/json'); // JSON formatında yanıt vereceğimizi belirtir

// Toplam ziyaretçi sayısını al
$query = 'SELECT SUM(visit_count) AS total FROM donerziyaretci'; // 'donerziyaretci' tablonuzun adı olmalı
$result = $con->query($query);

if (!$result) {
    die(json_encode(['error' => 'SQL sorgusu çalıştırılamadı.']));
}

$row = $result->fetch_assoc();
if ($row === false) {
    die(json_encode(['error' => 'Veri alınamadı.']));
}

// JSON yanıtı döndür
echo json_encode(['total' => (int)$row['total']]); // total'ı integer olarak döndür

// MySQLi bağlantısını kapat
$con->close();
?>
