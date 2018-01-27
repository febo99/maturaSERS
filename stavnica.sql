-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 31. okt 2017 ob 12.01
-- Različica strežnika: 10.1.26-MariaDB
-- Različica PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `stavnica`
--

-- --------------------------------------------------------

--
-- Struktura tabele `tekme`
--

CREATE TABLE `tekme` (
  `ID` int(11) NOT NULL,
  `Drzava` varchar(255) DEFAULT NULL,
  `Domaci` varchar(255) DEFAULT NULL,
  `Gosti` varchar(255) DEFAULT NULL,
  `goliDomaci` int(11) DEFAULT NULL,
  `goliGosti` int(11) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `tekme`
--

INSERT INTO `tekme` (`ID`, `Drzava`, `Domaci`, `Gosti`, `goliDomaci`, `goliGosti`, `Status`) VALUES
(1, ' OMAN', 'AL-NASR SALALAH', 'AL-ORUBA', 0, 1, '81\''),
(2, ' EUROPE (UEFA)', 'GEORGIA (U17)', 'ITALY (U17)', 0, 2, '48\''),
(3, ' EUROPE (UEFA)', 'MONTENEGRO (U17)', 'LATVIA (U17)', 0, 0, 'Int'),
(4, ' RUSSIA', 'FC UFA', 'RUBIN', 1, 1, 'H/T'),
(5, ' BULGARIA', 'DUNAV RUSE', 'SEPTEMVRI SOFIA', 0, 0, '28\''),
(6, ' OMAN', 'AL-NAHDA CLUB', 'AL-SALAM', 0, 0, ''),
(7, ' TURKEY', 'ANKARAGUCU', 'ISTANBULSPOR AS', 0, 0, ''),
(8, ' TURKEY', 'RIZESPOR', 'BOLUSPOR', 0, 0, ''),
(9, ' OMAN', 'AL-SHABAB SEEB', 'FANJA SC', 0, 0, ''),
(10, ' OMAN', 'OMAN CLUB', 'SAHAM', 0, 0, ''),
(11, ' ROMANIA', 'SEPSI OSK SFANTU GHEORGHE', 'FC BOTOSANI', 0, 0, ''),
(12, ' RUSSIA', 'AKHMAT GROZNY', 'ANZHI', 0, 0, ''),
(13, ' BULGARIA', 'LOKOMOTIV PLOVDIV', 'ETAR VELIKO TARNOVO', 0, 0, ''),
(14, ' CROATIA', 'ISTRA 1961', 'INTER ZAPRESIC', 0, 0, ''),
(15, ' GERMANY', 'TURBINE POTSDAM (W)', 'FRANKFURT (W)', 0, 0, ''),
(16, ' ISRAEL', 'BEITAR TEL AVIV', 'HAPOEL RAMAT GAN', 0, 0, ''),
(17, ' ISRAEL', 'HAPOEL AFULA', 'HAPOEL R. H. I. NIR', 0, 0, ''),
(18, ' ISRAEL', 'HAPOEL BNEY LOD FC', 'HAPOEL PETAH TIKVA', 0, 0, ''),
(19, ' MALTA', 'MOSTA FC', 'BALZAN FC', 0, 0, ''),
(20, ' POLAND', 'LECHIA GDANSK', 'KORONA KIELCE', 0, 0, ''),
(21, ' TURKEY', 'FENERBAHCE', 'KAYSERISPOR', 0, 0, ''),
(22, ' UKRAINE', 'CHORNOMORETS ODESA', 'FC MARIUPOL', 0, 0, ''),
(23, ' AUSTRIA', 'FC LIEFERING', 'WACKER INNSBRUCK', 0, 0, ''),
(24, ' GREECE', 'PAOK', 'ASTERAS TRIPOLIS', 0, 0, ''),
(25, ' DENMARK', 'BRONDBY', 'RANDERS FC', 0, 0, ''),
(26, ' NORWAY', 'LILLESTROM', 'AALESUND', 0, 0, ''),
(27, ' SWEDEN', 'AIK', 'IFK GOTEBORG', 0, 0, ''),
(28, ' SWEDEN', 'IFK NORRKOPING', 'OREBRO', 0, 0, ''),
(29, ' SWEDEN', 'NORRBY IF', 'IFK VARNAMO', 0, 0, ''),
(30, ' SWEDEN', 'OSTERS IF', 'IF BROMMAPOJKARNA', 0, 0, ''),
(31, ' SWEDEN', 'KIF OREBRO DFF (W)', 'DJURGARDEN (W)', 0, 0, ''),
(32, ' ROMANIA', 'DINAMO BUCURESTI', 'VIITORUL CONSTANTA', 0, 0, ''),
(33, ' ENGLAND', 'ASTON VILLA (U23)', 'NEWCASTLE (U23)', 0, 0, ''),
(34, ' ENGLAND', 'BLACKBURN (U23)', 'STOKE CITY (U23)', 0, 0, ''),
(35, ' ENGLAND', 'SOUTHAMPTON (U23)', 'BRIGHTON (U23)', 0, 0, ''),
(36, ' ENGLAND', 'WEST BROM (U23)', 'READING (U23)', 0, 0, ''),
(37, ' ISRAEL', 'MACCABI PETAH TIKVA', 'BNEI YEHUDA TEL AVIV', 0, 0, ''),
(38, ' SWITZERLAND', 'FC WIL 1900', 'SERVETTE FC', 0, 0, ''),
(39, ' GERMANY', 'WORMATIA WORMS', 'SV ELVERSBERG', 0, 0, ''),
(40, ' MALTA', 'SLIEMA WANDERERS', 'HAMRUN SPARTANS', 0, 0, ''),
(41, ' GERMANY', 'VFL BOCHUM', 'FORTUNA DUSSELDORF', 0, 0, ''),
(42, ' ITALY', 'TERNANA', 'CARPI', 0, 0, ''),
(43, ' SPAIN', 'GRANADA CF', 'LORCA FC', 0, 0, ''),
(44, ' FRANCE', 'CHATEAUROUX', 'LENS', 0, 0, ''),
(45, ' ITALY', 'VERONA', 'INTER', 0, 0, ''),
(46, ' ITALY', 'LECCE', 'COSENZA', 0, 0, ''),
(47, ' ENGLAND', 'BURNLEY', 'NEWCASTLE', 0, 0, ''),
(48, ' PORTUGAL', 'PORTIMONENSE', 'VITORIA SETUBAL', 0, 0, ''),
(49, ' SPAIN', 'ESPANYOL', 'BETIS', 0, 0, ''),
(50, ' SPAIN', 'LAS PALMAS', 'DEPORTIVO LA CORUNA', 0, 0, ''),
(51, ' PERU', 'COMERCIANTES UNIDOS', 'SPORT HUANCAYO', 0, 0, ''),
(52, ' PARAGUAY', 'SPORTIVO TRINIDENSE', 'INDEPENDIENTE F.B.C.', 0, 0, ''),
(53, ' ARGENTINA', 'ALMIRANTE BROWN', 'BARRACAS CENTRAL', 0, 0, ''),
(54, ' ARGENTINA', 'SAN TELMO', 'ACASSUSO', 0, 0, ''),
(55, ' ARGENTINA', 'VILLA SAN CARLOS', 'UAI URQUIZA', 0, 0, ''),
(56, ' ARGENTINA', 'SAN MIGUEL', 'TRISTAN SUAREZ', 0, 0, ''),
(57, ' EGYPT', 'MISR EL MAKASA', 'AL AHLY CAIRO', 0, 0, ''),
(58, ' SAUDI ARABIA', 'AL-ETTIFAQ', 'AL-AHLI JEDDAH', 0, 0, ''),
(59, ' SAUDI ARABIA', 'AL-QADISIYAH FC', 'AL-HILAL SAUDI FC', 0, 0, ''),
(60, ' ALBANIA', 'LACI', 'KAMZA', 0, 1, ''),
(61, ' BULGARIA', 'OBORISHTE', 'LUDOGORETS II', 0, 0, ''),
(62, ' GREECE', 'ACHARNAIKOS', 'APOLLON LARISSA FC', 1, 0, ''),
(63, ' GREECE', 'KISSAMIKOS', 'AE KARAISKAKIS', 1, 0, ''),
(64, ' GREECE', 'PANACHAIKI 2005', 'TRIKALA', 2, 0, ''),
(65, ' GREECE', 'PANSERRAIKOS', 'OFI', 1, 2, ''),
(66, ' UKRAINE', 'DESNA CHERNIHIV', 'FC POLTAVA', 1, 2, ''),
(67, ' OMAN', 'AL-MUDHAIBI SC', 'SOHAR', 0, 3, ''),
(68, ' OMAN', 'AL-SUWAIQ SC', 'MRBAT', 3, 1, ''),
(69, ' OMAN', 'MUSCAT CLUB', 'DHOFAR', 2, 1, ''),
(70, ' SERBIA', 'DINAMO VRANJE', 'CSK PIVARA', 1, 0, ''),
(71, ' SERBIA', 'PROLETER NOVI SAD', 'SINDJELIC BEOGRAD', 1, 0, ''),
(72, ' KOSOVO', 'FERONIKELI', 'GJILANI', 2, 1, ''),
(73, ' UKRAINE', 'ARSENAL KYIV', 'MFK MYKOLAIV', 3, 0, ''),
(74, ' INDONESIA', 'BALI UNITED PUSAM', 'SRIWIJAYA FC', 3, 2, ''),
(75, ' TURKEY', 'KECIORENGUCU', 'EYUPSPOR', 5, 1, ''),
(76, ' JAPAN', 'GAMBA OSAKA U23', 'GIRAVANZ KITAKYUSHU', 2, 2, ''),
(77, ' SOUTH KOREA', 'ICHEON DAEKYO (W)', 'DAEJON SPORTSTOTO (W)', 0, 0, ''),
(78, ' SOUTH KOREA', 'JEONBUK KSPO (W)', 'SEOUL AMAZONES (W)', 5, 1, ''),
(79, ' SOUTH KOREA', 'RED ANGELS (W)', 'BUSAN SANGMU (W)', 4, 0, ''),
(80, ' CHINESE TAIPEI', 'FU JEN UNIVERSITY', 'NSTC', 4, 2, ''),
(81, ' SOUTH KOREA', 'GYEONGJU KHNP (W)', 'SUWON (W)', 1, 4, ''),
(82, ' MEXICO', 'SANTOS LAGUNA', 'PACHUCA', 2, 2, ''),
(83, ' COLOMBIA', 'CORTULUA', 'MILLONARIOS', 0, 2, ''),
(84, ' BOLIVIA', 'BLOOMING', 'SAN JOSE', 2, 0, ''),
(85, ' USA', 'VANCOUVER WHITECAPS', 'SEATTLE SOUNDERS', 0, 0, ''),
(86, ' HONDURAS', 'CD HONDURAS', 'VIDA', 2, 1, ''),
(87, ' PARAGUAY', 'SPORTIVO LUQUENO', 'CLUB NACIONAL', 1, 1, ''),
(88, ' ARGENTINA', 'INDEPENDIENTE', 'PATRONATO', 1, 1, ''),
(89, ' COLOMBIA', 'INDEPENDIENTE MEDELLIN', 'JAGUARES', 2, 0, ''),
(90, ' COLOMBIA', 'SANTA FE', 'LA EQUIDAD', 0, 0, ''),
(91, ' EL SALVADOR', 'SANTA TECLA', 'MUNICIPAL LIMENO', 4, 0, ''),
(92, ' HONDURAS', 'CD OLIMPIA', 'CD MOTAGUA', 0, 0, '');

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `ID` int(11) NOT NULL,
  `uporabniskoIme` varchar(255) COLLATE utf8_bin NOT NULL,
  `geslo` varchar(255) COLLATE utf8_bin NOT NULL,
  `eposta` varchar(255) COLLATE utf8_bin NOT NULL,
  `konto` float NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`ID`, `uporabniskoIme`, `geslo`, `eposta`, `konto`) VALUES
(3, 'žđšđ', 'đžš', 's@ss', 100);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `tekme`
--
ALTER TABLE `tekme`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `tekme`
--
ALTER TABLE `tekme`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
