 

<?php
// kullanicisil.php
include("../../connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $txtkullanicisil = intval($_POST["id"]); // id'yi POST verisi olarak al

    // Prepare and bind
    $stmt = $con->prepare("DELETE FROM doner WHERE id = ?");
    $stmt->bind_param("i", $txtkullanicisil);

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
