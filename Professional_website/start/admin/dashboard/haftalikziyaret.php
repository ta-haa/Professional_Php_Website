<?php
include("../../connect.php");

// MySQLi bağlantısını kontrol et
if (!$con) {
    die(json_encode(['error' => 'Veritabanı bağlantısı sağlanamadı.']));
}

header('Content-Type: application/json');

// Haftalık ziyaretçi sayısını al
$query = '
    SELECT YEARWEEK(visit_date, 1) AS week, SUM(visit_count) AS total
    FROM donerziyaretci
    GROUP BY YEARWEEK(visit_date, 1)
    ORDER BY YEARWEEK(visit_date, 1)
';
$result = $con->query($query);

if (!$result) {
    die(json_encode(['error' => 'SQL sorgusu çalıştırılamadı.']));
}

$weeks = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $weeks[] = $row['week'];
    $totals[] = (int)$row['total'];
}

// JSON yanıtı döndür
echo json_encode(['weeks' => $weeks, 'totals' => $totals]);

// MySQLi bağlantısını kapat
$con->close();
?>
