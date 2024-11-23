 

<?php
// yetkiver.php
include("../../connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $txtyetkiver = intval($_POST["id"]); // id'yi POST verisi olarak al

    // Prepare and bind
    $stmt = $con->prepare("UPDATE doner SET yetki = 1 WHERE id = ?");
    $stmt->bind_param("i", $txtyetkiver); 

    // Execute and check
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    // Close the statement
    $stmt->close();
}

$con->close();
?>

