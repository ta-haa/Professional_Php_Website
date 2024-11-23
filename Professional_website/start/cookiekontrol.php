<?php 
///////////////////////////////////////////////////SESSİON VE COOKİE TOKEN'I SQLDEKİYLE DENKSE
///////////////////////////////////////////////////İNDEX.PHP YÖNLENDİR 
///////////////////////////////////////////////////DEĞİLSE LOGOUT.PHP YÖNLENDİR




//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////BU KISIM GEÇİCİDİR EĞER SORUNSUZ ÇALIŞIYORSA KALSIN //////////////////////////
////////////////////////DÜZGÜN ÇALIŞIYORSA COOKİEKONTROL.PHP DOSYASINI SİLMEYİ UNUTMA/////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

 
include("connect.php");

if (isset($_COOKIE['beni_hatirla']) && $_COOKIE['beni_hatirla'] == 'evet' && isset($_COOKIE['Gemail']) && isset($_COOKIE['token'])) {
    
    $_SESSION['Gemail'] = $_COOKIE['Gemail'];
    $_SESSION['token'] = $_COOKIE['token'];

    $email = $_COOKIE['Gemail'];
    $token = $_COOKIE['token'];

 
    $stmt = $con->prepare("SELECT * FROM doner WHERE eposta = ? AND token = ?");
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) { 
        header("Location: index.php"); 
        exit;  
    } else { 
        header("Location: logout.php"); 
        exit;  
    }

    $stmt->close();

}

else{
    header("Location: index.php"); 
    exit; 
} 

mysqli_close($con); 
 
?>