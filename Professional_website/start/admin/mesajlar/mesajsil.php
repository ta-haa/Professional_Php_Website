
<?php
include("../../connect.php");

if (isset($_POST["txtmesajsil"])) {
    $txtmesajsil = intval($_POST["txtmesajsil"]);
    
    // Prepare and bind
    $stmt = $con->prepare("DELETE FROM donercontact WHERE contactid = ?");
    $stmt->bind_param("i", $txtmesajsil);

    // Execute and check
    if ($stmt->execute()) {
        echo "Başarıyla silindi.";
    } else {
        echo "HATA: " . htmlspecialchars($stmt->error);
    }

    // Close the statement
    $stmt->close();
}

$con->close();
?>
