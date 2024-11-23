-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Kas 2024, 21:00:40
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `start`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doner`
--

CREATE TABLE `doner` (
  `id` int(11) NOT NULL,
  `eposta` varchar(200) NOT NULL,
  `sifre` varchar(200) NOT NULL,
  `token` varchar(200) DEFAULT NULL,
  `captcha` varchar(250) DEFAULT NULL,
  `captchaexpiry` datetime DEFAULT NULL,
  `verification` tinyint(1) DEFAULT NULL,
  `ipaddress` varchar(45) DEFAULT NULL,
  `yetki` tinyint(1) DEFAULT NULL,
  `kayit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `doner`
--

INSERT INTO `doner` (`id`, `eposta`, `sifre`, `token`, `captcha`, `captchaexpiry`, `verification`, `ipaddress`, `yetki`, `kayit`) VALUES
(120, 'taha@yahoo', 'taha@yahoo', 'taha@yahoo', 'taha@yahoo', '2014-11-18 22:53:52', 1, '172.164.1.1', 1, '2024-11-14 19:53:52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `donercontact`
--

CREATE TABLE `donercontact` (
  `contactid` int(6) NOT NULL,
  `contactad` varchar(200) NOT NULL,
  `contactemail` varchar(200) NOT NULL,
  `contactmesaj` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `donercontact`
--

INSERT INTO `donercontact` (`contactid`, `contactad`, `contactemail`, `contactmesaj`) VALUES
(20, 'ALI', 'ALICANDAN@GMAIL.COM', 'BEN POLAT...');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `donerlocation`
--

CREATE TABLE `donerlocation` (
  `konumid` int(6) NOT NULL,
  `konumlatitude` varchar(50) DEFAULT NULL,
  `konumlongitude` varchar(50) DEFAULT NULL,
  `konumcikisip` varchar(100) DEFAULT NULL,
  `konumtarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `donerlocation`
--

INSERT INTO `donerlocation` (`konumid`, `konumlatitude`, `konumlongitude`, `konumcikisip`, `konumtarih`) VALUES
(25, '52.3676', '4.9041', '172.121.53.27', '2024-05-10 19:57:42');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `donerziyaretci`
--

CREATE TABLE `donerziyaretci` (
  `ziyaretciid` int(6) NOT NULL,
  `visit_date` date NOT NULL,
  `visit_count` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `donerziyaretci`
--

INSERT INTO `donerziyaretci` (`ziyaretciid`, `visit_date`, `visit_count`) VALUES
(16, '2024-04-02', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `doner`
--
ALTER TABLE `doner`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `donercontact`
--
ALTER TABLE `donercontact`
  ADD PRIMARY KEY (`contactid`);

--
-- Tablo için indeksler `donerlocation`
--
ALTER TABLE `donerlocation`
  ADD PRIMARY KEY (`konumid`);

--
-- Tablo için indeksler `donerziyaretci`
--
ALTER TABLE `donerziyaretci`
  ADD PRIMARY KEY (`ziyaretciid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `doner`
--
ALTER TABLE `doner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Tablo için AUTO_INCREMENT değeri `donercontact`
--
ALTER TABLE `donercontact`
  MODIFY `contactid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `donerlocation`
--
ALTER TABLE `donerlocation`
  MODIFY `konumid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `donerziyaretci`
--
ALTER TABLE `donerziyaretci`
  MODIFY `ziyaretciid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
