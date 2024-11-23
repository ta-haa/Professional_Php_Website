<?php
include("../../connect.php");

// MySQLi bağlantısını kontrol et
if (!$con) {
    die(json_encode(['error' => 'Veritabanı bağlantısı sağlanamadı.']));
}

header('Content-Type: application/json');

// Günlük ziyaretçi sayısını al
$query = '
    SELECT DATE(visit_date) AS date, SUM(visit_count) AS total
    FROM donerziyaretci
    GROUP BY DATE(visit_date)
    ORDER BY DATE(visit_date)
';
$result = $con->query($query);

if (!$result) {
    die(json_encode(['error' => 'SQL sorgusu çalıştırılamadı.']));
}

$dates = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = $row['date'];
    $totals[] = (int)$row['total'];
}

// JSON yanıtı döndür
echo json_encode(['dates' => $dates, 'totals' => $totals]);

// MySQLi bağlantısını kapat
$con->close();
?>
