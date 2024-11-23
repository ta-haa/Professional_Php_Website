<?php
include("../../connect.php");

// MySQLi bağlantısını kontrol et
if (!$con) {
    die(json_encode(['error' => 'Veritabanı bağlantısı sağlanamadı.']));
}

header('Content-Type: application/json');

// Aylık ziyaretçi sayısını al
$query = '
    SELECT DATE_FORMAT(visit_date, "%Y-%m") AS month, SUM(visit_count) AS total
    FROM donerziyaretci
    GROUP BY DATE_FORMAT(visit_date, "%Y-%m")
    ORDER BY DATE_FORMAT(visit_date, "%Y-%m")
';
$result = $con->query($query);

if (!$result) {
    die(json_encode(['error' => 'SQL sorgusu çalıştırılamadı.']));
}

$months = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $totals[] = (int)$row['total'];
}

// JSON yanıtı döndür
echo json_encode(['months' => $months, 'totals' => $totals]);

// MySQLi bağlantısını kapat
$con->close();
?>
