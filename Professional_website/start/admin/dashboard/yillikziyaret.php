<?php
include("../../connect.php");

// MySQLi bağlantısını kontrol et
if (!$con) {
    die(json_encode(['error' => 'Veritabanı bağlantısı sağlanamadı.']));
}

header('Content-Type: application/json');

// Yıllık ziyaretçi sayısını al
$query = '
    SELECT YEAR(visit_date) AS year, SUM(visit_count) AS total
    FROM donerziyaretci
    GROUP BY YEAR(visit_date)
    ORDER BY YEAR(visit_date)
';
$result = $con->query($query);

if (!$result) {
    die(json_encode(['error' => 'SQL sorgusu çalıştırılamadı.']));
}

$years = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $years[] = $row['year'];
    $totals[] = (int)$row['total'];
}

// JSON yanıtı döndür
echo json_encode(['years' => $years, 'totals' => $totals]);

// MySQLi bağlantısını kapat
$con->close();
?>
