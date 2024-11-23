<!DOCTYPE html> 
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  

    <title>Admin Paneli</title> 
    <link rel="stylesheet" href="admin.css">
</head>
<body>  

    <noscript>
        <meta http-equiv="refresh" content="0 ; url=https://www.youtube.com/channel/UCbJFy2KTBclbYfcaQFKZapQ">
    </noscript>

<?php
//ADMİN KONTROL.PHP
//SAYFA YÜKLENDİĞİNDE İÇERİSİNDE MENÜ AÇILIP KAPANMA BİDE FETCH İLE MESAJ.PHP VE KULLANİCİ.PHP DOSYASINI ÇEKEN KOD VAR 
//EĞER KULLANICIDAN SESSİON EMAİL VE TOKEN ALIRSA VE YETKİ = 1 İSE JAVASCRİPT KODLARINI ÇEK
include("adminkontrol.php");
?>

    <button class="toggle-button">☰</button>
 
    <div class="sidebar" id="sidebar">
        <h2>Admin Paneli</h2>
        <ul>
            <li><button data-section="dashboard">Dashboard</button></li>
            <li><button data-section="users">Kullanıcılar</button></li>
            <li><button data-section="messages">Mesajlar</button></li>  
<!-- 
            <li><button data-section="social">Sosyal Medya</button></li>
-->
            <a href="./../login/logout.php"><li><button data-section="exit">Çıkış</button></li></a>
        </ul>
    </div> 

    <div class="main-content" id="mainContent">
        <div id="dashboard" class="content-section active">
            <h1>Dashboard</h1>
            <p>Burada genel istatistikler ve özet bilgileri görebilirsiniz.</p>
            <div class="chart-container">
                <div class="chart-wrapper">
                    <canvas id="dailyChart"></canvas>
                </div>
                <div class="chart-wrapper">
                    <canvas id="weeklyChart"></canvas>
                </div>
                <div class="chart-wrapper">
                    <canvas id="monthlyChart"></canvas>
                </div>
                <div class="chart-wrapper">
                    <canvas id="yearlyChart"></canvas>
                </div> 
            </div>
            <br/><br/>
            <div class="donut-chart-container">
                <div class="donut-chart-wrapper">
                    <canvas id="donutChart1"></canvas>
                </div>
                <div class="donut-chart-wrapper">
                    <canvas id="donutChart2"></canvas>
                </div>
                <div class="donut-chart-wrapper">
                    <canvas id="donutChart3"></canvas>
                </div>
            </div>
        </div>

        <div id="users" class="content-section">
            <h1>Kullanıcılar Content</h1>


<!-- Burası aslında kullanici.php dosyasındaydı lakin filter kısmı adminpanel.php yerine sadece kullanici.php 
 dosyasında çalışıyodu lakin buraya alınca sorunsuz çalıştır -->
 <!-- BURDAKİ DİVLER kullanici.PHP DOSYASININ -->

 <div class="header"> 
            <div class="filter"> 
                <div class="form-group">
                    <input type="text" id="user-id" placeholder=" ">
                    <label for="user-id" class="label">ID:</label>
                    <div class="underline"></div>
                </div>

                <div class="form-group">
                    <input type="email" id="user-email" placeholder=" ">
                    <label for="user-email" class="label">Email:</label>
                    <div class="underline"></div>
                </div>

                <div class="form-group">
                    <select id="user-verification">
                        <option value="">Select</option>
                        <option value="1">Verified</option>
                        <option value="0">Unverified</option>
                    </select>
                    <label for="user-verification" class="label">Verification:</label>
                    <div class="underline"></div>
                </div>

                <div class="form-group">
                    <input type="text" id="user-ip-address" placeholder=" ">
                    <label for="user-ip-address" class="label">IP Address:</label>
                    <div class="underline"></div>
                </div>

                <div class="form-group">
                    <input type="date" id="user-registration-date">
                    <label for="user-registration-date" class="label">Registration Date:</label>
                    <div class="underline"></div>
                </div>

                <button id="user-filter-button" class="tablesearch">Filter</button>
                <button id="user-clear-button" class="clear-filter">Clear</button>
            <span id="user-status-message" class="status-message"></span>
            </div>
        </div>

            <div id="users-content">
                <!-- Kullanıcı verileri burada gösterilecek -->
            </div>
        </div>


        <div id="messages" class="content-section">
            <h1>Mesajlar Content</h1> 

            <!-- Burası aslında mesaj.php dosyasındaydı lakin filter kısmı adminpanel.php yerine sadece mesaj.php 
            dosyasında çalışıyodu lakin buraya alınca sorunsuz çalıştır -->
            <!-- BURDAKİ DİVLER MESAJ.PHP DOSYASININ -->
            <div class="header">
            <div class="filter">
            <div class="form-group">
                <input type="text" id="message-id" placeholder=" ">
                <label for="message-id" class="label">ID:</label>
                <div class="underline"></div>
            </div>

            <div class="form-group">
                <input type="text" id="message-ad" placeholder=" ">
                <label for="message-ad" class="label">Ad:</label>
                <div class="underline"></div>
            </div>

            <div class="form-group">
                <input type="email" id="message-gonderen" placeholder=" ">
                <label for="message-gonderen" class="label">Gönderen:</label>
                <div class="underline"></div>
            </div>

            <div class="form-group">
                <input type="text" id="message-mesaj" placeholder=" ">
                <label for="message-mesaj" class="label">Mesaj:</label>
                <div class="underline"></div>
            </div> 

            <button id="message-filter-button" class="tablesearch">Filter</button>
            <button id="clear-filter-button" class="clear-filter">Clear</button>
            <span id="status-message" class="status-message"></span>
        </div>
    </div> 
            <div id="messages-content">
                <!-- Mesajlar burada gösterilecek --> 
            </div>
        </div>  

        <div id="social" class="content-section">
            <h1>Sosyal Medya Content</h1>
        </div>
        <div id="exit" class="content-section">
            <h1>Çıkış Content</h1>
        </div>
    </div>




    <!-- NAVİGATOR ONLİNE SÜREYLE TİTLE DEĞİŞME GİBİ JAVASCRİPT KODLARI VAR -->
    <script src="./admin.js"></script>

    <!-- CHARTLARIN KÜTÜPHANESİ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CHARTLARIN CHART ÖZELLİKLERİ -->
    <script src="./dashboard/chart.js"></script>

    
    <!-- KULLANICILARDAKİ FİLTER ÖZELLİKLERİ  -->
    <script src="./kullanicilar/kullanici.js"></script>

    <!-- MESAJLARDAKİ FİLTER ÖZELLİKLERİ  -->
    <script src="./mesajlar/mesaj.js"></script>




 
</body>
</html>
 